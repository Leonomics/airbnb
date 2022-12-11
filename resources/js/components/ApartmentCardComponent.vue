<template>
    <div class="card flex flex-col h-full relative">
        <figure class="pb-2/3 relative rounded-xl overflow-hidden">
            <img class="absolute w-full h-full object-cover object-center" :src="apartment.pic_path" alt="immagine appartamento">
        </figure>
        <span class="truncate text-gray-700 text-xl font-bold py-2">{{apartment.title}}</span>
        <div class="flex justify-between">
            <span>
                {{address}}                
            </span>

            <span class="whitespace-no-wrap">
                {{price}} &euro;
            </span>
        </div>
        <div v-if="(distance !== undefined)" class="text-sm">
            Dista {{distance}} km
        </div>
        <div class="absolute sponsored" v-if="checkDate(apartment)">
            <p>In evidenza</p>
        </div>
    </div>
</template>

<script>

export default {
    props:{
        apartment: Object,
        distance: Number,
    },
    computed: {
        price() {
            const [ price, decimal ] = this.apartment.price.split('.')
            return price
        },
        address() {
            const [ address, cityInfo ] = this.apartment.address.split(', ')
            const [ postalCode , city ] = cityInfo.split(' ')
            return `${address}, ${city}`
        }
    },
    methods: {
        checkDate(apartment) {
            let isSponsored = false
            if(apartment.sponsors.length > 0) {
                apartment.sponsors.forEach(sponsor => {
                    let date = sponsor.pivot.expire_date
                    if(date) {
                        const now = new Date()
                        date = new Date(date)
                        isSponsored = now < date ? date : null
                    }                   
                });
            }
            return isSponsored
        }
    },   
}
</script>

<style lang="scss" scoped>
    // img {
    //     aspect-ratio: 1;
    // }
    .card img{
        transform: scale(1);
        transition: transform 1s;
    }
    .card:hover img {
        transform: scale(1.2);
    }
    .sponsored {
        top: 5px;
        right: 5px;
        background-color: rgba($color: #ff385c, $alpha: 0.7);
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 10px;
    }
</style>