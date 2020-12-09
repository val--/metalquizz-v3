<template>
    <v-card class="questions-container d-flex justify-center pa-6">
    	<div v-if="questions">
            <div class="text-center mb-6">
                <v-progress-circular
                  :rotate="-90"
                  :size="100"
                  :width="15"
                  :value="countdownValue"
                  :color="progressColor"
                >
                {{ secondsLeft }}
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
            secondsLeft : 20
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
            this.interval = setInterval(() => {
            if(this.secondsLeft > 0){
                this.countdownValue += this.countDownTicks;
                this.secondsLeft--;
            }
            }, 1000);
        },
        goToNextQuestion() {
            this.currentQuestionIndex++;
            clearInterval(this.interval);
            this.countdownValue = 0;
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
                return 'green';
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
    ul {
        list-style-type: none;
    }
}
</style>