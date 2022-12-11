<template>
  <div class="flex flex-col container">
      <div v-show="fetchDone">
          <div v-if="visible">
              <p @click="goBack" class="block text-brand-500 pt-5 cursor-pointer">
              <i class="fa-chevron-left fa-solid"></i> Torna indietro
              </p>
              <div v-if="apartment" class="font-semibold text-5xl">
              <h2 class="text-black font-bold pt-7">
                  {{ apartment.title }}
              </h2>
              </div>
              <div class="pt-6 pb-8">
              {{ apartment.address }}
              </div>
              <!-- <div class="grid grid-cols-1 md:grid-cols-3 gallery gap-6 pb-12">
                  <img class="md:object-cover md:w-full md:h-full rounded-xl md:col-span-2 md:row-span-2" :src="apartment.pic_path" alt="">
                  <div class="grid grid-rows-2 gap-y-5">
                  <img class="hidden md:block md:object-cover md:w-full md:h-full rounded-xl md:row-span-1 md:col-span-1" v-for="(img, i) in apartment.images" :key="i" :src="img.img_path" alt="">
                  </div>
              </div> -->
              <div class="grid grid-cols-3 gap-x-6 pb-10">
                  <div class="col-span-3" :class="{'lg:col-span-2': apartment.images.length > 0}">
                      <img class="test object-cover md:w-full h-full rounded-xl" :src="apartment.pic_path" alt="" />
                  </div>
                  <div class="hidden lg:block">
                      <div class="grid gap-y-5">
                      <img class="max-w-full rounded-xl" v-for="(img, i) in apartment.images" :key="i" :src="img.img_path"
                          alt="" />
                      </div>
                  </div>
              </div>
      
              <div class="grid grid-cols-1 md:grid-cols-3 gap-y-5 gap-x-6 pb-10">
              <div class="
                  grid
                  md:col-span-2
                  grid-cols-1
                  md:grid-cols-2
                  lg:col-span-2 lg:grid-cols-4
                  gap-y-5
                  border
                  p-6
                  rounded-lg
                  ">
                  <div class="flex flex-col pr-13 items-start lg:pr-16 self-center">
                  <h4 class="pb-3">Stanze totali</h4>
                  <p class="font-bold text-center text-black">
                      {{ apartment.rooms_number }}
                  </p>
                  </div>
                  <div class="flex flex-col pr-13 items-start lg:pr-16 self-center">
                  <h4 class="pb-3">Camere da letto</h4>
                  <p class="font-bold text-center text-black">
                      {{ apartment.beds_number }}
                  </p>
                  </div>
                  <div class="flex flex-col pr-13 items-start lg:pr-16 self-center">
                  <h4 class="pb-3">Bagni</h4>
                  <p class="font-bold text-center text-black">
                      {{ apartment.bath_number }}
                  </p>
                  </div>
                  <div class="flex flex-col pr-13 items-start lg:pr-16 self-center">
                  <h4 class="pb-3">Metri quadrati</h4>
                  <p class="font-bold text-center text-black">
                      {{ apartment.meters }}
                  </p>
                  </div>
              </div>
      
              <div class="
                  grid
                  border
                  rounded-lg
                  p-6
                  md:row-span-2
                  h-96
                  lg:col-span-1
                  drop-shadow-xl
                  shadow-m
                  ">
                  <div class="flex pb-8">
                  <h4 class="text-brand-500 text-2xl font-bold">{{new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(apartment.price)}} &nbsp; </h4>
                  <p class="self-center">notte</p>
                  </div>
                  <div class="flex justify-between pb-8">
                  <div>{{new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(apartment.price)}} x 5 notti</div>
                  <div>{{new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(apartment.price * 5)}}</div>
                  </div>
                  <div class="flex justify-between pb-8">
                  <div>Costi di pulizia</div>
                  <div>{{new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(Math.round((apartment.price * 5)*0.5/100*100)/100)}}</div>
                  </div>
                  <div class="flex justify-between pb-8">
                  <div>Costi del servizio</div>
                  <div>{{new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(Math.round((apartment.price * 5)*2/100*100)/100)}}</div>
                  </div>
                  <hr class="pb-8" />
                  <div class="flex justify-between pb-3">
                  <div class="font-bold">Totale</div>
                  <div class="font-bold">{{new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(Math.round((apartment.price * 5 + (apartment.price * 5)*0.5/100 + (apartment.price * 5)*2/100)*100)/100)}}</div>
                  </div>
                  <!-- BUTTON PRENOTAZIONE -->
                  <!-- <div class="flex justify-center">
                  <button class="text-white bg-brand-500 w-4/5 h-12 rounded-md">Prenota</button>
                  </div> -->
              </div>
      
              <div class="col-span-1 md:col-span-2 p-6 rounded-lg border">
                  <p class="text-2xl font-semibold text-black pb-7">Cosa troverai</p>
                  <div class="">
                  <ul class="content-center gap-8 grid grid-flow-col grid-rows-2">
                      <li v-for="(service, i) in apartment.services" :key="i" class="flex gap-4">
                      <!-- DA RIVEDERE -->
                      <i v-if="service.name === 'Piscina'" class="fa-solid fa-person-swimming"></i>
                      <i v-if="service.name === 'Sauna'" class="fa-solid fa-spa"></i>
                      <i v-if="service.name === 'Posto Macchina'" class="fa-solid fa-car"></i>
                      <i v-if="service.name === 'Portineria'" class="fa-solid fa-bell-concierge"></i>
                      <i v-if="service.name === 'Vista Mare'" class="fa-solid fa-water"></i>
                      <i v-if="service.name === 'WiFi'" class="fa-solid fa-wifi"></i>
                      {{ service.name }}
                      </li>
                  </ul>
                  </div>
              </div>
              </div>
      
              <div class="py-10">
              <p class="text-2xl font-semibold text-black pb-5">Dove ti troverai</p>
      
              <!-- ******** MAPPA ******** -->
      
              <div>
                  <div class="map rounded-xl" ref="map"></div>
              </div>
              </div>
      
              <p class="text-2xl font-semibold text-black pt-10 pb-5">
              Lascia un messaggio
              </p>
      
              <!-- POPUP MESSAGE SUCCEED -->
              <div v-if="popup" class="fixed popup_wrapper inset-x-0 inset-y-0  flex justify-center items-center z-10">
                  <div class="flex px-3 py-6 rounded-xl bg-white text-brand-500 text-bold text-3xl">
                  Messaggio inviato correttamente!
                  </div>
              </div>
      
              <div class="flex items-center justify-center">
              <!-- Author: FormBold Team -->
              <!-- Learn More: https://formbold.com -->
              <div class="mx-auto w-full max-w-[550px]">
                  <div class="mb-5">
                  <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                      Nome
                  </label>
                  <input type="text" v-model="msgName" name="name" id="name" placeholder="Nome" class="
                      w-full
                      rounded-md
                      border border-[#e0e0e0]
                      bg-white
                      py-3
                      px-6
                      text-base
                      font-medium
                      text-[#6B7280]
                      outline-none
                      focus:border-[#6A64F1] focus:shadow-md
                      " />
                  <p class="text-red-700 py-6" v-if="errors.name">
                      Il nome deve contenere minimo 3 caratteri
                  </p>
                  </div>
                  <div class="mb-5">
                  <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                      Cognome
                  </label>
                  <input type="text" name="name" v-model="msgLastname" id="name" placeholder="Cognome" class="
                      w-full
                      rounded-md
                      border border-[#e0e0e0]
                      bg-white
                      py-3
                      px-6
                      text-base
                      font-medium
                      text-[#6B7280]
                      outline-none
                      focus:border-[#6A64F1] focus:shadow-md
                      " />
      
                  <p class="text-red-700 py-6" v-if="errors.surname">
                      Il cognome deve contenere minimo 2 caratteri
                  </p>
                  </div>
                  <div class="mb-5">
                  <label for="email" class="mb-3 block text-base font-medium text-[#07074D]">
                      Email
                  </label>
                  <input type="email" name="email" v-model="msgEmail" required
                      pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,4}$" id="email" placeholder="esempio@mail.com" class="
                      w-full
                      rounded-md
                      border border-[#e0e0e0]
                      bg-white
                      py-3
                      px-6
                      text-base
                      font-medium
                      text-[#6B7280]
                      outline-none
                      focus:border-[#6A64F1] focus:shadow-md
                      " />
      
                  <p class="text-red-700 py-6" v-if="errors.email">
                      Formato dell'email non è valido
                  </p>
                  </div>
      
                  <div class="mb-5">
                  <label for="message" class="mb-3 block text-base font-medium text-[#07074D]">
                      Messaggio
                  </label>
                  <textarea v-model="msgTxt" rows="4" name="message" id="message" placeholder="Inserisci il tuo messaggio"
                      class="
                      w-full
                      resize-none
                      rounded-md
                      border border-[#e0e0e0]
                      bg-white
                      py-3
                      px-6
                      text-base
                      font-medium
                      text-[#6B7280]
                      outline-none
                      focus:border-[#6A64F1] focus:shadow-md
                      "></textarea>
      
                  <p class="text-red-700 py-6" v-if="errors.text">
                      Il testo è obbligatorio
                  </p>
                  </div>
                  <div>
                  <button @click="submitMessage()" class="
                      bg-brand-500
                      hover:shadow-form
                      rounded-md
                      bg-[#6A64F1]
                      py-3
                      px-8
                      text-base
                      font-semibold
                      text-white
                      ">
                      Invia all'host
                  </button>
                  </div>
              </div>
              </div>
              <div v-show="!visible" class="
                  container
                  flex flex-col
                  gap-5
                  justify-center
                  items-center
                  h-full
                  text-center
                  my-auto
                  ">
                  <i class="
                      fa-solid fa-circle-exclamation
                      text-5xl
                      sm:text-6xl
                      text-gray-300
                  "></i>
                  <h3 class="text-3xl max-w-md sm:max-w-full sm:text-4xl md:text-5xl">
                  Appartamento non disponibile
                  </h3>
                  <a href="/" class="text-brand-500 hover:underline">Torna alla home</a>
              </div>
          </div>
      </div>    
      <div v-show="!fetchDone" class="container flex flex-col flex-grow justify-center items-center">
          <LoaderComponent/>
      </div>
  </div>
</template>

<script>
import tt from "@tomtom-international/web-sdk-maps";
import LoaderComponent from "../components/LoaderComponent.vue";

export default {
  props: ["id"],
  computed: {
    visible() {
      return this.apartment && this.apartment.visible;
    },
  },
  data() {
    return {
      lat: null,
      lng: null,
      position: [],
      map: null,
      apartment: "",
      msgName: "",
      msgLastname: "",
      msgEmail: "",
      msgTxt: "",
      popup: false,
      errors: "",
      mapCreation: false,
      fetchDone: false,
      user: this.$root.user,
    };
  },
  components: {
  LoaderComponent,
  },
  methods: {
    goBack() {
      if(window.history.length > 0) {
        this.$router.back();
      }
    },
    fetchDetails() {
      axios.get(`/api/apartments/${this.id}`).then((res) => {
        const { apartment } = res.data;
        this.apartment = apartment;
        this.lng = apartment.longitude;
        this.lat = apartment.latitude;
      }).finally(() => {
      this.fetchDone = true
      });
    },
    moveMap(lnglat) {
      this.map.flyTo({
        center: lnglat,
        zoom: 14,
      });
    },
    addMark() {
      const popupOffsets = {
        top: [0, 0],
        bottom: [0, -30],
        "bottom-right": [0, -30],
        "bottom-left": [0, -30],
        left: [25, -35],
        right: [-25, -35],
      };
      const mark = new tt.Marker().setLngLat(this.position).addTo(this.map);
      const popup = new tt.Popup({ offset: popupOffsets }).setHTML(
        "Il tuo appartmaento"
      );
      mark.setPopup(popup).togglePopup();
    },
    submitMessage(){
      if(this.msgName && this.msgEmail && this.msgTxt){
        axios.post(`/api/messages/`,{
          name: this.msgName,
          surname: this.msgLastname,
          email: this.msgEmail,
          text: this.msgTxt,
          apartment_id: this.id
        }).then(res => {
          this.popup = true
          this.msgName = ''
          this.msgLastname = ''
          this.msgTxt = ''
          this.msgEmail = ''
          setTimeout(()=>{
            this.popup = false

          },2000)
        }).catch(err => {
          const {response} = err.request
          const errors = JSON.parse(response)
          this.errors = errors.errors
        })
      }else{
        return alert('Compila i campi mancanti!')
      }
    },
    createMap() {
      if(!this.mapCreation){
        this.position = [this.lng, this.lat]
        this.map = tt.map({
          key: "as0gbWig8K0G3KPY9VcGrsNm44fzb73h",
          container: this.$refs.map,
          center: this.position,
        });
        this.map.on(new tt.FullscreenControl());
        this.map.on(new tt.NavigationControl());
        this.mapCreation = true
      }
    }
  },
  created() {
    this.fetchDetails();
    if(this.user) {
      this.msgName = this.user.name
      this.msgLastname = this.user.surname
      this.msgEmail = this.user.email
    }
    window.scrollTo(0, 0)
  },
  updated(){
    this.createMap()
  },
  watch:{
    mapCreation(a,b){
      if(a != b){
        this.moveMap(this.position)
        this.addMark()
      }
    },
  }
};
</script>

<style lang="scss" scoped>
.test {
  width: 100%;
  height: 100%;
}

.map {
  max-width: 100%;
  height: 416px;
}

.popup_wrapper {
  backdrop-filter: blur(20px);
  background-color: rgba(255, 255, 255, 0.494);
}

.mapboxgl-canvas {
  max-width: 100% !important;
}
</style>