<template>
    <div>
        <vue-dropzone
            ref="imagesContainer"
            id="imagesContainer"
            :options="dropzoneOptions"
            @vdropzone-file-added="change"
            @vdropzone-removed-file="change"
        ></vue-dropzone>
    </div>
</template>
<script>
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'
    export default {
        props:{
            value:{
                required: true
            },
            limit: {
                default: null
            },
            images: {
                default: null
            },
            thumbnailWidth: {
                default: 100
            }
        },
        components: {
          vueDropzone: vue2Dropzone
        },
        created(){
            this.$nextTick(() => {
                if (this.images) {
                    this.loadImages(this.images)
                }
            });
        },
        data() {
            return {
                dropzoneOptions: {
                    url: 'http://localhost',
                    thumbnailMethod: 'contain',
                    maxFilesize: 2,
                    headers: { "My-Awesome-Header": "header value" },
                    autoProcessQueue: false,
                    maxFiles: this.limit,
                    addRemoveLinks: true,
                    thumbnailWidth: this.thumbnailWidth,
                },
            }
        },
        methods: {
            loadImages(images){
                console.log(images);
                images.map((image) => {
                  var file = { id: image.id, size: this.thumbnailWidth, name: image.name }
                  this.$refs.imagesContainer.manuallyAddFile(file, image.url)
                })
            },
            change(){
                if(this.limit != null && this.drop.files.length > this.limit){
                    this.drop.removeFile(this.drop.files[this.limit])
                }
                this.$emit('input', this.drop.files)
            },
        },
        computed: {
            drop(){
                return this.$refs.imagesContainer.dropzone
            }
        },
    }
</script>
<style>
.dz-progress {
  display: none !important;
}
.dz-details {
    opacity: 0.3 !important;
}
#customdropzone .dz-preview .dz-image > div {
    width: inherit;
    height: inherit;
    border-radius: 50%;
    background-size: contain;
  }
  #customdropzone .dz-preview .dz-image > img {
    width: 100%;
  }
</style>