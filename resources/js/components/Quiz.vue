<template>
    <div class="questions-container">
        <v-card class="questions d-flex justify-center pa-6">
            <!-- QUIZ IN PROGRESS -->
        	<div v-if="questions && state === 'starting' || state === 'running'">
                <div class="text-center mb-6">
                    <v-progress-circular
                      :rotate="-90"
                      :size="100"
                      :width="15"
                      :value="countdownValue"
                      :color="progressColor"
                    >
                    <span v-if="answerConfirmationFeedback">
                        <v-icon>mdi-checkbox-marked-circle</v-icon>
                    </span>
                    <span v-else>
                        {{ secondsLeft }}
                    </span>
                    
                    </v-progress-circular>
                </div>
                <p class="text-center">{{ currentQuestion.question}}</p>
                <v-row>
                    <v-col cols="6" v-for="answer in currentQuestion.answers" :key="answer.id" @click="checkIfAnswerIsCorrect(answer.id)" class="text-center">
                        <v-btn
                            block
                            color="secondary"
                        >
                          {{ answer.answer }}
                        </v-btn>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col class="mt-6">
                        <p class="text-center">Votre score : {{ score }}</p>
                    </v-col>
                </v-row>
            </div>
            <!-- LOST SCREEN -->
            <div v-else-if="state === 'lost'" class="text-center">
                <p>Perdu ! </p>
                <p>Votre score est de {{ score }}</p>
                <p><a href="#" @click="restartQuizz()">Réessayer ?</a></p>
            </div>
        </v-card>
    </div>
</template>

<script>
export default {
    data(){
        return{
        	state : 'starting',
        	questions : null,
        	currentQuestionIndex : 0,
            score : 0,

            interval: {},
            countdownValue: 0,
            maxCountdownValue : 20,
            countDownTicks : 100 / 20,
            secondsLeft : 20,
            answerConfirmationFeedback : null
        }
    },
    created() {
        this.fetchQuestions();
    },
    mounted () {
        this.countdownTick();
    },
    methods: {
		fetchQuestions() {
			this.state = 'loading';
			axios.get('/api/questions').then(({ data }) => {
				let res = data.data;
				this.questions = res;
			}).finally(() => this.startQuiz());
		},
		startQuiz() {
			this.state = 'running';
        },
        countdownTick() {
            let vm = this;
            this.interval = setInterval(() => {
            if(this.secondsLeft > 0){
                if(vm.answerConfirmationFeedback){
                    vm.answerConfirmationFeedback = null;
                }
                this.countdownValue += this.countDownTicks;
                this.secondsLeft--;
            }
            }, 1000);
        },
        checkIfAnswerIsCorrect(answer_id) {
            let vm = this;
            const formData = new FormData();
            formData.append('submitted_answer_id', answer_id);
            formData.append('correct_answer_id',  this.currentQuestion.right_answer);
            axios.post('/api/check_correct_answer', formData)
            .then(function(data){
                vm.goToNextQuestion();
            }).catch(error => {
                vm.endQuizz();
            })
            //return true;
        },
        goToNextQuestion() {
            this.currentQuestionIndex++;
            this.score += this.secondsLeft;
            clearInterval(this.interval);
            this.countdownValue = 0;
            this.answerConfirmationFeedback = 'OK';
            this.secondsLeft = this.maxCountdownValue;
            this.countdownTick();
        },
        endQuizz() {
            this.resetQuestionsAndTimer();
            this.state = 'lost';
        },
        resetQuestionsAndTimer() {
            this.secondsLeft = 0;
            this.countdownValue = 0;
            this.questions = null;
        },
        restartQuizz() {
            location.reload();
            // TODO
        }
    },
    computed : {
        currentQuestion: function () {
            return this.questions[this.currentQuestionIndex];
        },
        progressColor : function () {
            if(this.secondsLeft > this.maxCountdownValue /4){
                return 'white';
            }else{
                return 'primary';
            }
        }
    },
    beforeDestroy () {
      clearInterval(this.interval)
    },
}
</script>

<style lang="scss" scoped>
    .questions-container {
        display: flex;
        align-items: center;
        justify-content: center;

        .questions {
            width:920px;
            ul {
                list-style-type: none;
            }
        }
    }
</style>