<template>
    <div class="container text-center flex items-center lg:text-left">
      <div class="flex lg:gap-5 justify-between">
        <div>
          <p class="_oops text-black">
            Oops!
          </p>
          <p class="_error_message font-semibold">
            Sembra che la pagina che stai cercando non esista.
          </p>
          <p class="_error_code font-bold">
            Codice di errore: 404
          </p>
          <p class="_useful_links font-semibold">
            Di seguito alcuni link utili:
          </p>
          <ul>
            <li class="text-brand-500"><a href="/">Home</a></li>
            <li class="text-brand-500"><a href="/ricerca-avanzata">Cerca</a></li>
          </ul>
        </div>
        <div class="hidden lg:block">
          <img src="" alt="">
        </div>
      </div>
    </div>
</template>

<script>
export default {

}

</script>

<style lang="scss" scoped>
  ._oops{
    font-size: 136px;
    font-weight: 700;
    color: #484848;
    margin-bottom: 64px;
  }
  ._error_message{
    font-size: 32px;
    margin-bottom: 32px;
    font-size: 32px;
  }
  ._error_code{
    margin-bottom: 32px;
    //font-size: 16px;
  }
  ._useful_links{
    margin-bottom: 12px;
  }

  li{
    margin-bottom: 6px;
  }

</style>