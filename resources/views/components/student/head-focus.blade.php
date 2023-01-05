<nav
    class="bg-tertiary flex w-full justify-between font-black text-lg text-secondary px-1 md:px-8 pt-1 border-b-4 border-accent">
    <a href="/home">
        @svg('logos/pluggamatte-monogram', 'h-20 fill-primary text-transparent')
    </a>
    <div class="flex flex-col justify-center items-center text-sm md:text-md text-center w-1/2" >
        <template x-if="$store.learnView.title">
           <div x-html="$store.learnView.title"></div>
        </template>
        <template x-if="$store.learnView.type == 'exerciseBlock.start'">
            <div>
                <div x-html="$store.learn.currentTopic.name"></div>
                <div x-html="$store.learn.currentLearningSequence.title"></div>
            </div>
        </template>
        <template x-if="$store.learnView.type == 'question.solve'">
            <div class="w-full bg-gray-100 rounded-lg relative overflow-hidden" x-data="{
            get percentCompleted(){
             return this.$store.learn.questionCounter/ this.$store.learn.currentExerciseBlock.required_no_questions * 100;
            }
        }">
                <div class="absolute top-0 w-full" x-text="percentCompleted + '%'"></div>
               <div class="text-center bg-amber-300 left-0 top-0" :style="{ width: percentCompleted + '%' }" >&nbsp;</div>
            </div>
        </template>
    </div>
    <button @click="$store.learnView.changeView({view:'main'})">{{ __('Close') }}</button>
</nav>
