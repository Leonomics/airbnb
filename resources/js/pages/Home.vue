<template>
  <main class="flex flex-col items-center">
    <!-- Jumbo -->
    <section class="pb-10 container">
      <div class="items-center bg-brand-300 py-20 px-6 rounded-xl">
        <h1 class="text-4xl md:text-6xl font-bold text-gray-700 pb-12 text-center">Trova il tuo appartamento ideale</h1>
        <SearchInput class="mx-auto bg-white"/>
      </div>
    </section>
    <!-- Cards Appartamenti -->
    <section v-show="fetchAll && fetchSponsor && fetchCity" class="container pb-10" v-if="(apartments && apartments.length > 0)">
      <div class="md:flex text-center justify-between items-end">
        <h2 class="text-3xl text-gray-700 font-bold">Appartamenti in Evidenza</h2>
        <!-- <a href="#" class="underline hidden md:block">Vedi tutto</a> -->
      </div>
      <div v-if="apartments" class="grid grid-flow-row gap-x-6 gap-y-8 grid-cols-1 md:grid-cols-2 2xl:grid-cols-4 py-6">
        <router-link v-for="(apartment, index) in apartments" :key="index" :to="{ name: 'apartments.show', params: { id: apartment.id }}">
          <ApartmentCard :apartment="apartment"/>
        </router-link>
      </div>
    </section>
    <section v-show="fetchAll && fetchSponsor && fetchCity" v-for="(city, index) in cities" :key="index" :class="index === cities.length - 1 ? 'mb-0' : 'mb-10'" class="container">
      <h2 class="text-center md:text-left mb-2 text-3xl text-gray-700 font-bold">Appartmaneti a {{ city }}</h2>
      <div v-if="apartments_by_city" class="grid gap-x-6 gap-y-8 grid-cols-1 md:grid-cols-2 2xl:grid-cols-4">
        <router-link v-for="apartment in apartments_by_city[city]" :key="apartment.id" :to="{ name: 'apartments.show', params: { id: apartment.id }}">
          <ApartmentCard :apartment="apartment"/>
        </router-link>
      </div>
    </section>
    <section v-show="!(fetchAll && fetchSponsor && fetchCity)" class="container flex flex-col flex-grow justify-center items-center">
      <LoaderComponent/>
    </section>
  </main>
</template>

<script>
import ApartmentCard from '../components/ApartmentCardComponent.vue';
import LoaderComponent from '../components/LoaderComponent.vue';
import SearchInput from '../components/SearchInputComponent.vue';

export default {
  components: {
    ApartmentCard,
    SearchInput,
    LoaderComponent,
  },
  data() {
    return {
      all_apartments: [],
      apartments: null,
      fetchSponsor: false,
      fetchCity: false,
      fetchAll: false,
      cities: []
    }
  },
  computed: {
    apartments_by_city() {
      const data = {}

      this.cities.forEach(city => {
        data[city] = []
      })

      this.all_apartments.forEach(apartment => {
        const { city } = apartment

        if (data[city] && data[city].length < 4) {
          data[city].push(apartment)
        }
      })

      return data
    }
  },
  methods: {
    fetchPosts() {
      this.fetchSponsor = false
      axios.get('/api/apartments/index/sponsored')
        .then(res => {
          const { apartments } = res.data
          // apartments.forEach(el => {
          //   el.price = el.price.split('.')[0];
          //   el.address = el.address.split(' ').pop();
          // });
          this.apartments = apartments
        }).finally(() => {
          this.fetchSponsor = true
        })
    },
    fetchPostByCity() {
      this.fetchCity = false
      axios.get('/api/apartments/index/cities').then(res => {
        const { apartments } = res.data
        const cities = []
        apartments.forEach(apartment => {
          cities.push(apartment.city)
        });
        this.cities = cities
      }).finally(() => {
        this.fetchCity = true
      })
    },
    fetchAllApartments() {
      this.fetchAll = false
      axios.get('/api/apartments/index/all')
        .then(res => {
          const { apartments } = res.data
          this.all_apartments = apartments
        }).finally(() => {
          this.fetchAll = true
        })
    },
  },
  created() {
    this.fetchPosts()
    this.fetchPostByCity()
    this.fetchAllApartments()
    window.scrollTo(0, 0)
  },
  updated() {
    window.scrollTo(0, 0)
  }
}
</script>

<style lang="scss" scoped>

</style>