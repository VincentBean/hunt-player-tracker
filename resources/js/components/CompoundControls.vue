<template>
    <li>
        <div class="blocks">
            <div class="flex items-center py-2 sm:px-6">
                <div class="min-w-0 flex-1 flex items-center">
                    <div class="flex min-w-0 flex-1">
                        <div class="w-1/3">
                            <p class="text-sm font-medium text-red-600 truncate">{{ name }}</p>
                        </div>
                        <div class="flex-1">
                            <button v-on:click="exclude(code)" v-if="!excluded" type="button"
                                    class="mx-auto inline-flex items-center px-2 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-gray-200 border-red-800 bg-red-900 hover:bg-red-800 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-3 w-3 mr-1" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Exclude
                            </button>
                            <button v-on:click="include(code)" v-if="excluded" type="button"
                                    class="mx-auto inline-flex items-center px-2 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-gray-200 border-red-800 bg-red-900 hover:bg-red-800 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Include
                            </button>
                            <button v-on:click="shot(code)" type="button"
                                    class="mx-auto inline-flex items-center px-2 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-gray-200 border-red-800 bg-red-900 hover:bg-red-800 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Shot
                            </button>
                            <button v-on:click="fight(code)" type="button"
                                    class="mx-auto inline-flex items-center px-2 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-gray-200 border-red-800 bg-red-900 hover:bg-red-800 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Fight
                            </button>
                            <button v-on:click="boss(code)" type="button"
                                    class="mx-auto inline-flex items-center px-2 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-gray-200 border-red-800 bg-red-900 hover:bg-red-800 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                Boss
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
export default {
    name: "CompoundControls",
    props: ['code', 'name'],

    data() {
        return {
            excluded: false
        }
    },

    methods: {
        setExcluded(excluded) {
            this.excluded = excluded;
        },
        exclude() {
            window.axios.post('/vertex/exclude', {lobby: this.$parent.lobby, code: this.code});
            this.excluded = true;
        },
        include() {
            window.axios.post('/vertex/include', {lobby: this.$parent.lobby, code: this.code});
            this.excluded = false;
        },
        shot() {
            window.axios.post('/vertex/activity/increaseWeight', {lobby: this.$parent.lobby, code: this.code, increase: 1});
        },
        fight() {
            window.axios.post('/vertex/activity/increaseWeight', {lobby: this.$parent.lobby, code: this.code, increase: 2});
        },
        boss() {
            window.axios.post('/vertex/activity/boss', {lobby: this.$parent.lobby, code: this.code});
        }
    }
}
</script>

<style scoped>

</style>
