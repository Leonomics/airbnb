<template>
	<main v-if="apartments">
		<!-- hero -->
		<div class="container py-8 mb-10 text-center">
			<div class="text-sm mb-2">Risultati di ricerca per</div>
			<SearchInput @positionSelected="onSelect" :addr="address" class="mx-auto" />
		</div>

		<!-- header filters -->
		<div class="container">
			<div class="flex flex-wrap items-center mb-4 gap-6 lg:w-3/4 lg:pl-4 lg:ml-auto">
				<div class="font-bold">{{ filtered_apartments.length }} Appartamenti</div>

				<!-- <div>
					<span v-for="(filter, i) in filters" :key="filter[i]">{{ filter[0] }}</span>
				</div> -->

				<!-- <select class="ml-auto">
					<option data="">Ordina per</option>
					<option value="">Rilevanza</option>
					<option value="">Data di aggiunta</option>
					<option value="">Distanza</option>
				</select> -->
				
				<div @click="toggleFilters" class="lg:hidden">
					<i class="fa-solid fa-filter"></i>
				</div>

				<div v-if="show & screen < 1024" class="w-full mb-8 text-sm">
					<AccordionFilter @filter="onFilter" :class="i === categories.length -1 ? 'border-b' : ''" v-for="(category, i) in categories" :key="i" :info="category" />
				</div>
			</div>
		</div>

		<!-- filters & cards -->
		<div class="container lg:flex lg:items-start lg:gap-6">
			<div v-if="screen >= 1024" class="block lg:w-1/4 text-sm">
				<AccordionFilter @filter="onFilter" :class="i === categories.length -1 ? 'border-b' : ''" v-for="(category, i) in categories" :key="i" :info="category" />
			</div>
			<div class="lg:w-3/4 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-10 xl:grid-cols-3">
				<router-link v-for="(info, i) in filtered_apartments" :key="i" :to="{ name: 'apartments.show', params: { id: info.id }}">
					<ApartmentCard :apartment="info" :distance="distances[i]"/>
				</router-link>
			</div>
		</div>
	</main>
</template>

<script>
import SearchInput from '../components/SearchInputComponent.vue'
import AccordionFilter from '../components/AccordionFilter.vue'
import ApartmentCard from '../components/ApartmentCardComponent.vue'

const categories = [
	{
		title: 'Numero minimo di stanze',
		type: 'radio',
		name: 'rooms_number',
		filters: [

			{
				label: '1',
				id: 'room-1',
				value: 1,
				checked: true
			},
			{
				label: '2',
				id: 'room-2',
				value: 2,
				checked: false
			},
			{
				label: '3',
				id: 'room-3',
				value: 3,
				checked: false
			},
			{
				label: '4',
				id: 'room-4',
				value: 4,
				checked: false
			},
		]
	},
	{
		title: 'Numero minimo di letti',
		type: 'radio',
		name: 'beds_number',
		filters: [
			{
				label: '1',
				id: 'beds-1',
				value: 1,
				checked: true
			},
			{
				label: '2',
				id: 'beds-2',
				value: 2,
				checked: false
			},	
			{
				label: '3',
				id: 'beds-3',
				value: 3,
				checked: false
			},
			{
				label: '4',
				id: 'beds-4',
				value: 4,
				checked: false
			},	
		]
	},	
	{
		title: 'Distanza',
		type: 'radio',
		name: 'distance',
		filters: [
			{
				label: '5 km',
				id: 'distance-1',
				value: 5,
				checked: false
			},
			{
				label: '10 km',
				id: 'distance-2',
				value: 10,
				checked: false
			},	
			{
				label: '20 km',
				id: 'distance-3',
				value: 20,
				checked: true
			},
			{
				label: '50 km',
				id: 'distance-4',
				value: 50,
				checked: false
			},
		]
	},
	{
		title: 'Servizi',
		type: 'checkbox',
		name: 'services',
		filters: [
			{
				label: 'WiFi',
				id: 'wifi',
				value: 'WiFi',
			},
			{
				label: 'Posto Macchina',
				id: 'posto-macchina',
				value: 'Posto Macchina',
			},	
			{
				label: 'Piscina',
				id: 'piscina',
				value: 'Piscina',
			},
			{
				label: 'Portineria',
				id: 'portineria',
				value: 'Portineria',
			},
			{
				label: 'Sauna',
				id: 'sauna',
				value: 'Sauna',
			},
			{
				label: 'Vista Mare',
				id: 'vista-mare',
				value: 'Vista Mare',
			},	
		]
	},	
]

export default {
	data() {
		return {
			show: false,
			screen: window.innerWidth,
			apartments: [],
			distances: [],
			categories,
			service_list: [],
			filters: {
				rooms_number: null,
				beds_number: null,
				distance: 20,
				services: [],
			},
			latitude: null,
			longitude: null,
			address: this.$route.query.addr ? this.$route.query.addr : '',
		}
	},
	components: {
		SearchInput,
		AccordionFilter,
		ApartmentCard,
	},
	computed: {
		urlAddress() {
			return this.$route.query.addr
		},
		urlLat() {
			return this.$route.query.lat
		},
		urlLon() {
			return this.$route.query.lon
		},
		filtered_apartments() {
			this.filtered = false
			let filtered = this.apartments.filter(apartment => {
				let visible = true
				for (const [key, value] of Object.entries(this.filters)) {
					if(key.endsWith('_number')) {
						if(!value) {
							visible = visible && true
						} else {					
							visible = visible && apartment[key] >= value
						}
					}
					if(key === 'distance') {
						if(this.latitude && this.longitude) {
							const distance = this.getDistanceFromLatLonInKm(apartment.latitude, apartment.longitude, this.latitude, this.longitude)
							visible = visible && distance <= this.filters.distance
						} else {
							visible = visible && true
						}
					}
					if(key === 'services') {
						let hasService = false
						let selected = true
						if(value.length === 0) {
							hasService = true
						} else {
							const apartmentServices = apartment[key]
							value.forEach(filterService => {
								hasService = false
								apartmentServices.forEach(apartmentService => {
									hasService = hasService || filterService === apartmentService.name									
								})
								selected = selected && hasService
							})
						}
						visible = visible && selected
					}
				}
				this.filtered = true
				return visible
			})
			filtered.sort((ap1, ap2) => {
				let date1 = null
				let date2 = null
				const now = new Date()
				const distance1 = this.getDistanceFromLatLonInKm(this.latitude, this.longitude, ap1.latitude, ap1.longitude)
				const distance2 = this.getDistanceFromLatLonInKm(this.latitude, this.longitude, ap2.latitude, ap2.longitude)
				if(ap1.sponsors.length > 0) {
					ap1.sponsors.every(sponsor => {
						date1 = new Date(sponsor.pivot.expire_date)
						date1 = now < date1 ? true : false
						return !date1
					})
				}											
				if(ap2.sponsors.length > 0) {
					ap2.sponsors.every(sponsor => {
						date2 = new Date(sponsor.pivot.expire_date)
						date2 = now < date2 ? true : false
						return !date2
					})
				}	
				if(date1 && !date2) {
					return -1
				} else if(!date1 && date2) {
					return 1
				} else {
					if(distance1 > distance2) {
						return 1
					}
					if(distance1 < distance2) {
						return -1
					}
					return 0
				}
			})
			if(this.latitude && this.longitude) {
				this.distances = filtered.map(apartment => {
					const distance = this.getDistanceFromLatLonInKm(apartment.latitude, apartment.longitude, this.latitude, this.longitude)
					return Math.round(distance)
				})
			} else {
				this.distances = []
			}
			return filtered
		},	
	},
	methods: {
		onFilter(data) {			
			const [ name, value ] = data
			if (name === 'services') {
				if (!this.filters.services.includes(value)) {
					this.filters['services'].push(value)
				} else {
					const index = this.filters['services'].indexOf(value)
					this.filters['services'].splice(index, 1)
				}
			} else {
				this.filters[name] = value
			}
		},
		onSelect(data) {
			const [latitude, longitude] = data
			this.latitude = latitude
			this.longitude = longitude
		},
		fetchApartments() {
			this.fetchDone = false
			axios.get('api/apartments/index/all').then(res => {
				const { apartments, service_list } = res.data
				this.apartments = apartments
				this.service_list = service_list
			}).finally(() => {
				this.fetchDone = true
			})
		},
		toggleFilters() {
			return this.show = !this.show
		},
		getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
			var R = 6371; // Radius of the earth in km
			var dLat = this.deg2rad(lat2-lat1);  // deg2rad below
			var dLon = this.deg2rad(lon2-lon1); 
			var a = 
				Math.sin(dLat/2) * Math.sin(dLat/2) +
				Math.cos(this.deg2rad(lat1)) * Math.cos(this.deg2rad(lat2)) * 
				Math.sin(dLon/2) * Math.sin(dLon/2)
				; 
			var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
			var d = R * c; // Distance in km
			return d;
		},
		deg2rad(deg) {
			return deg * (Math.PI/180)
		},
	},
	created() {
		this.fetchApartments()
		window.scrollTo(0, 0)
	},
	mounted() {
		this.latitude = this.$route.query.lat ? this.$route.query.lat : null;
		this.longitude = this.$route.query.lon ? this.$route.query.lon : null;
		this.address = this.$route.query.addr ? this.$route.query.addr : null;
		window.addEventListener('resize', () => {
			this.screen = window.innerWidth
		})
	},
	updated() {
		window.scrollTo(0, 0)
	},
	watch: {
		urlAddress: function(newValue, oldValue) {
			if(newValue != oldValue) {
				this.address = this.urlAddress
			}
		},
		urlLat: function(newValue, oldValue) {
			if(newValue != oldValue) {
				this.latitude = this.urlLat
			}
		},
		urlLon: function(newValue, oldValue) {
			if(newValue != oldValue) {
				this.longitude = this.urlLon
			}
		},
	},
}
</script>

<style lang="scss" scoped>
.search-box {
	max-width: 650px;
}
</style>