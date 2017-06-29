<template>
  <div class="modal is-active" style="z-index: 9999">

    <div class="modal-background" @click="$emit('clk-close-modal')"></div>

    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title"> {{ title }} </p>
        <button class="delete" @click="$emit('clk-close-modal')"></button>
      </header>

      <section class="modal-card-body">
        <slot></slot>
      </section>

      <footer class="modal-card-foot" style="margin-top:0">
          <slot name="buttons">
            
          </slot>
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