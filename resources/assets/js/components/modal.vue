<template>
  <div class="modal is-active" style="z-index: 9999">

    <div class="modal-background" @click="$emit('clk-close-modal')"></div>

    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title"> {{ title }} </p>
        <button class="delete" @click="$event.preventDefault();$emit('clk-close-modal')"></button>
      </header>

      <section class="modal-card-body">
        <slot></slot>
      </section>

      <footer class="modal-card-foot width-100" style="">
        <slot name="buttons"></slot>
      </footer>
    </div>
  </div>
</template>


<script>
  export default{
    props: {
      title: {default: 'default title'},
    },

    methods: {
      
    }
  }
</script>