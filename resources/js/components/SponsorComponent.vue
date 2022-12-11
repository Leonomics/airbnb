<template>
    <div class="fixed top-0 bottom-0 flex left-0 right-0 items-center justify-center bg-black bg-opacity-25 z-10">
        
        <div class="flex flex-col bg-white wrapper dark:bg-gray-900 w-96 relative rounded-lg">
                <div v-if="!paymentMethodVisible" class="container px-6 py-8 mx-auto">
                    <p class="text-xl text-center text-gray-500 dark:text-gray-300">
                        Scegli il tuo piano
                    </p>
                    

                    <h1 class="mt-4 text-3xl font-semibold text-center text-gray-800 capitalize lg:text-4xl dark:text-white">Promozioni disponibili</h1>


                    <div class="mt-6 space-y-8 xl:mt-12">


                        <div v-bind:class="{'border-gray-700': current === sponsor.id}" v-on:click="(setCurrent(sponsor.id), showPayment(sponsor.id), getDuration(sponsor.duration))" class="flex items-center justify-between max-w-2xl px-8 py-4 mx-auto border cursor-pointer rounded-xl dark:border-gray-700 classObject" v-for="sponsor in fetchedSponsors" :key="sponsor.id">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 sm:h-9 sm:w-9" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>


                                <div class="flex flex-col items-center mx-5 space-y-1" >
                                    <h2 class="text-lg font-medium text-gray-700 sm:text-2xl dark:text-gray-200">{{sponsor.plan}}</h2>
                                    <div class="px-2 text-xs text-blue-500 bg-gray-100 rounded-full sm:px-4 sm:py-1 dark:bg-gray-700 ">
                                        {{sponsor.duration}} ore
                                    </div>
                                </div>
                            </div>

                            <h2 class="text-2xl font-semibold text-gray-500 sm:text-4xl dark:text-gray-300">€{{sponsor.price}}</h2>
                        </div>
                    </div>
                </div>
                <div v-if="paymentMethodVisible" class="flex flex-col items-center content-center container h-full">
                    <payment-component :duration="duration" :apartment="apartment" :id="sponsorId"/>
                </div>
                <div class="absolute top-2 right-2 flex pb-8">
                    <button class="p-2 close rounded-lg mx-auto text-white" @click="close()"><i class="text-red-600 text-2xl fa-sharp fa-solid fa-circle-xmark"></i></button>
                </div>
            </div>
        </div>
</template>

<script>
    import axios from 'axios'
    export default{
        props:{
            apartment: Object
        },

        data(){
            return{
                fetchedSponsors:[],
                paymentMethodVisible: false,
                sponsorId: 0,
                current: null,
                duration: null,
            }

        },
        methods: {
            fetchSponsors() {
                axios.get('/api/sponsors')
                .then((res) => {
                    this.fetchedSponsors = res.data.sponsors
                })
            },

            addActive(sponsors){
                sponsors.forEach(sponsor=>{
                    sponsor.isActive = false
                })
            },

            showPayment(sponsor){
                this.sponsorId = sponsor
                this.paymentMethodVisible = !this.paymentMethodVisible
            },

            getDuration(duration) {
                this.duration = duration
            },

            setCurrent(id){
                this.current = id
            },

            close(){
                this.$emit('show-plans')
            },
        },
        mounted() {
            this.fetchSponsors()
        },
    }
</script>

<style lang="scss" scoped>
    .wrapper{
        height: 600px;
    }

    .close{
        outline: none,
    }
</style>