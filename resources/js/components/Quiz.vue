<template>
    <div class="questions-container">
        <v-card class="questions d-flex justify-center pa-6">
        	<div v-if="questions">
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
                    <v-col cols="6" v-for="answer in currentQuestion.answers" :key="answer.id" @click="goToNextQuestion()" class="text-center">
                        <v-btn
                            block
                            color="secondary"
                        >
                          {{ answer.answer }}
                        </v-btn>
                    </v-col>
                </v-row>
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
        goToNextQuestion() {
            this.currentQuestionIndex++;
            clearInterval(this.interval);
            this.countdownValue = 0;
            this.answerConfirmationFeedback = 'OK';
            this.secondsLeft = this.maxCountdownValue;
            this.countdownTick();
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