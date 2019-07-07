<template>
  <atom-spinner
      :animation-duration="1000"
      :size="size"
      :color="color"
      class="spinner"
  />
</template>
<script>
    import {AtomSpinner} from 'epic-spinners'
    export default {
        props: ['size','color'],
        components: {
            AtomSpinner
        },
    }
</script>