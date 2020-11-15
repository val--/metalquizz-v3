<template>
	<section>
		<v-card width="600" class="mx-auto pa-6">
			<div v-if="questionIndex<quiz.questions.length" v-bind:key="questionIndex">
				<header>
					Votre score : {{ score }}
				</header>
				<v-row>
					<v-col class="text-center">
						<circular-count-down-timer
					        :initial-value="countDownInitialValue"
					        :steps="20"
					        :size="200"
					        :seconds-stroke-color="'#34495e'"
					        @update="updated"
					        ref="countdown"
						></circular-count-down-timer>
					</v-col>
				</v-row>
				<h5 class="text-h5 mt-4 mb-4">{{ quiz.questions[questionIndex].text }}</h5>
				<div>
					<div 
						v-for="(response, index) in quiz.questions[questionIndex].responses" 
						@click="selectOption(index)" 
						:class="{ 'is-selected': userResponses[questionIndex] == index}" 
						:key="index"
						>
					{{ index+1 }}. {{ response.text }}
					</div>
				</div>

				<footer class="questionFooter">
					<div>
						<a class="button" :class="(userResponses[questionIndex]==null)?'':'is-active'" v-on:click="next();" :disabled="questionIndex>=quiz.questions.length">
	                    {{ (userResponses[questionIndex]==null)?'Skip':'Next' }}
	                  	</a>
					</div>
				</footer>
			</div>

			<div v-if="questionIndex >= quiz.questions.length" v-bind:key="questionIndex" class="quizCompleted has-text-centered">
				<span class="icon"><i class="fa" :class="score()>3?'fa-check-circle-o is-active':'fa-times-circle'"></i></span>
				<h2 class="title">
					You did {{ (score()>7?'an amazing':(score()<4?'a poor':'a good')) }} job!
				</h2>
				<p class="subtitle">
					Total score: {{ score() }} / {{ quiz.questions.length }}
				</p>
				<br>
				<a class="button" @click="restart()">restart <i class="fa fa-refresh"></i></a>
			</div>
		</v-card>
	</section>
</template>

<script>

	var quiz = {
      user: "Dave",
      questions: [
         {
            text: "What is the full form of HTTP?",
            responses: [
               { text: "Hyper text transfer package" },
               { text: "Hyper text transfer protocol", correct: true },
               { text: "Hyphenation text test program" },
               { text: "None of the above" }
            ]
         },
         {
            text: "HTML document start and end with which tag pairs?",
            responses: [
               { text: "HTML", correct: true },
               { text: "WEB" },
               { text: "HEAD" },
               { text: "BODY" }
            ]
         },
         {
            text: "Which tag is used to create body text in HTML?",
            responses: [
               { text: "HEAD" },
               { text: "BODY", correct: true },
               { text: "TITLE" },
               { text: "TEXT" }
            ]
         },
         {
            text: "Outlook Express is _________",
            responses: [
               { text: "E-Mail Client", correct: true },
               { text: "Browser" },
               {
                  text: "Search Engine"
               },
               { text: "None of the above" }
            ]
         },
         {
            text: "What is a search engine?",
            responses: [
               { text: "A hardware component " },
               {
                  text: "A machinery engine that search data"
               },
               { text: "A web site that searches anything", correct: true },
               { text: "A program that searches engines" }
            ]
         },
         {
            text:
               "What does the .com domain represents?",
            responses: [
               { text: "Network" },
               { text: "Education" },
               { text: "Commercial", correct: true },
               { text: "None of the above" }
            ]
         },
         {
            text: "In Satellite based communication, VSAT stands for? ",
            responses: [
               { text: " Very Small Aperture Terminal", correct: true },
               { text: "Varying Size Aperture Terminal " },
               {
                  text: "Very Small Analog Terminal"
               },
               { text: "None of the above" }
            ]
         },
         {
            text: "What is the full form of TCP/IP? ",
            responses: [
               { text: "Telephone call protocol / international protocol" },
               { text: "Transmission control protocol / internet protocol", correct: true },
               { text: "Transport control protocol / internet protocol " },
               { text: "None of the above" }
            ]
         },
         {
            text:
               "What is the full form of HTML?",
            responses: [
               {
                  text: "Hyper text marking language"
               },
               { text: "Hyphenation text markup language " },
               { text: "Hyper text markup language", correct: true },
               { text: "Hyphenation test marking language" }
            ]
         },
         {
            text: "\"Yahoo\", \"Infoseek\" and \"Lycos\" are _________?",
            responses: [
               { text: "Browsers " },
               { text: "Search Engines", correct: true },
               { text: "News Group" },
               { text: "None of the above" }
            ]
         }
      ]
   },
   userResponseSkelaton = Array(quiz.questions.length).fill(null);


import CircularCountDownTimer from "./CircularCountDownTimer";

export default {
    data(){
        return{
			quiz: quiz,
			questionIndex: 0,
			userResponses: userResponseSkelaton,
			isActive: false,
			countDownInitialValue: 20,
			countdownValue: 20,
			pause: false,
			score: 0
        }
    },
    components : {
    	CircularCountDownTimer
    },
   	methods: {
		restart: function(){
			this.score = 0;
			this.setTime(this.countDownInitialValue);
			this.questionIndex=0;
			this.userResponses=Array(this.quiz.questions.length).fill(null);
		},
		selectOption: function(index) {
			Vue.set(this.userResponses, this.questionIndex, index);
			//console.log(this.userResponses);
		},
		next: function() {
			if (this.questionIndex < this.quiz.questions.length){
				this.score += this.countdownValue;
				this.setTime(this.countDownInitialValue);
				this.questionIndex++;
			}
		},
      // Return "true" count in userResponses
		score: function() {
			var score = 0;
			for (let i = 0; i < this.userResponses.length; i++) {
				if (typeof this.quiz.questions[i].responses[this.userResponses[i]] !== "undefined" &&this.quiz.questions[i].responses[this.userResponses[i]].correct) {
					score = score + 1;
				}
			}
			return score;
		},
      	setTime: function (seconds) {
      		this.$refs.countdown.updateTime(seconds - this.countdownValue)
      		this.pause = false
    	},
		updated: function (status) {
			if (status.value === 0) {
				this.pause = true
			} else {
				this.pause = false
			}
			this.countdownValue = status.value
		}
  	}
}
</script>