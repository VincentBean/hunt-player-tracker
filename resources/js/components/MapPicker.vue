<template>
    <div>
        <h1 class="text-4xl text-red-800 text-shadow-lg text-center">Pick a map</h1>

        <div class="flex mt-4">
            <div class="m-auto space-x-4">
                <button v-on:click="setMap('bayou')" type="button" :class="{ 'bg-red-900': this.$parent.map == 'bayou' }"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-gray-200 border-red-800 hover:bg-red-900 focus:outline-none">
                    Stillwater Bayou
                </button>

                <button v-on:click="setMap('lawson')" type="button" :class="{ 'bg-red-900': this.$parent.map == 'lawson' }"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-gray-200 border-red-800 hover:bg-red-900 focus:outline-none">
                    Lawson Delta
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "MapPicker",

    methods: {
        setMap(map) {
            this.$parent.map = map;
        }

    }
}
</script>

<style scoped>

</style>
