<template>
    <div ref="searchWrapper" :class="{'size rounded-full relative z-50': guest}" class="relative address-wrapper">
        <div>
            <label v-if="(!guest && page === 'create')" for="address" class="text-2xl font-bold block mb-2">Indirizzo *</label>
            <label v-if="(!guest && page === 'edit')" for="address" class="text-2xl font-bold block mb-2">Indirizzo</label>
            
            <div class="mb-2" :class="{'search-box flex items-center rounded-full border-gray-700 border-2': guest}">
                <i v-if="guest" class="fa-solid fa-magnifying-glass text-xl text-gray-700"></i>
                <input @keyup="showResult" type="text" name="address" id="address" v-model="address" :class="{'w-full mx-3 text-base text-gray-700 font-bold outline': guest, 'address p-2 w-full': !guest}" :placeholder="guest ? 'Cerca un appartamento...' : 'Inserisci un indirizzo'" autocomplete="off">
                <i @click="clearInput" v-if="guest" class="fa-solid fa-circle-xmark text-xl text-gray-300 hover:text-brand-300"></i>
            </div>
        </div>

        <ul class="absolute top-0 left-0 w-full mb-4 rounded bg-white results-list" v-if="(results && results.length > 0 && address != '')">
            <li @click="getResult(result)" v-for="(result, index) in results" :key="index" class="result cursor-pointer px-2 py-3">
                {{result.address.freeformAddress}}
            </li>
        </ul>
        
        <div v-if="!guest" class="address-error"></div>

        <input class="p-2 flex-grow" type="hidden" name="latitude" v-model="latitude">
        <input class="p-2 flex-grow" type="hidden" name="longitude" v-model="longitude">
        <input v-if="isBackend" class="p-2 flex-grow" type="hidden" name="city" v-model="city">
    </div>
</template>


<script>

    export default{
        props: ['addr', 'page'],
        computed: {
            isBackend() {
                return typeof this.$route === 'undefined'
            }
        },
        data(){
            return{
                typeahead: true,
                limit: 5,
                language: "it-IT",
                countrySet: "IT",
                minFuzzyLevel: 1,
                maxFuzzyLevel: 2,
                latitude: '',
                longitude: '',
                city: '',
                address: this.addr ? this.addr : '',
                results: null,
                guest: false
            }
        },
        methods: {
            clearInput() {
                this.address = ''
                this.latitude = null
                this.longitude = null
                if(this.isBackend) {
                    this.city = null
                }
                this.getResult()
            },
            showResult() {
                if(this.$route) {
                    if(this.$route.name !== 'home') {
                        if(this.address) {
                            this.fetchResult()           
                        } else {
                            this.results = null
                            this.latitude = null
                            this.longitude = null                    
                            this.city = null                    
                            // this.$emit('positionSelected', [
                            //     this.latitude,
                            //     this.longitude
                            // ])
                            this.getResult(this.results)
                        }
                    } else {
                        if(this.address) {
                            this.fetchResult()           
                        }
                    }
                } else {
                    this.fetchResult()
                }
            },
            getResult(result) {
                this.results = null                
                this.city = result ? result.address.countrySecondarySubdivision : result
                this.latitude = result ? result.position.lat : result
                this.longitude = result ? result.position.lon : result
                this.address = result ? result.address.freeformAddress : result
                // if(this.$route.name === 'advanced-search') {
                //     this.$router.push({ path: '/ricerca-avanzata', query: {
                //         lat: this.latitude,
                //         lon: this.longitude,
                //         addr: this.address
                //     } })
                // }
                if(this.$route) {
                    if(this.$route.name === 'home' || this.$route.name === 'advanced-search') {
                        this.$router.push({ path: '/ricerca-avanzata', query: {
                            lat: this.latitude === null ? undefined : this.latitude,
                            lon: this.longitude === null ? undefined : this.longitude,
                            addr: this.address === null ? undefined : this.address
                        } })
                    }
                }
            },
            fetchResult() {
                axios.get("/api/search/".concat(this.address))
                    .then(res => {
                        const { results } = res.data
                        this.results = results.results.filter(result => {
                            return result.type != 'Cross Street'
                        })
                    })       
                    .catch(err => {
                        this.results = null
                    })  
                axios.interceptors.response.use(response => {
                    if(this.address) {
                        return response
                    } else {
                        this.results = null
                    }
                }, error => {
                    return Promise.reject(error)
                })
            },
            isFront() {
                if (this.$route) {
                    this.guest = true
                }
            },
        },
        mounted() {
            this.isFront()
        }
    }
</script>

<style lang="scss" scoped>
.size {
    max-width: 640px;
}
.results-list {
    top: 70px;
    border: 2px solid black;
    .result {
        &:hover {
            background-color: lightgray;
        }
    }
}
.search-box {
    padding: 1.125rem 1.5rem;
}

input::placeholder {
    color: #C3C6D1;
    font-weight: 400;
}
.outline {
    outline: none;
}
</style>