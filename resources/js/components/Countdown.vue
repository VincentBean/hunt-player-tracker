<template>
    <h1 class="text-red-800 text-4xl text-center">Countdown: {{ countdown }}</h1>
</template>

<script>
export default {
    name: "Countdown",

    data() {
        return {
            countdown: 60,
            timer: null
        }
    },

    methods: {
        start() {
            let self = this;

            this.timer = setInterval(function() {
                if (self.countdown <= 0) return

                self.countdown--
            }, 1000 * 60)
        },
        reset() {
            clearInterval(this.timer);
            this.countdown = 60;
        }
    }
}
</script>

<style scoped>

</style>
