<template>
  <div class>
    <input type="file" name="image" ref="imageInput" style="display:none;" @change="previewImage" />
    <img
      :src="image"
      alt="Photo"
      class="img-thumbnail mb-10"
      width="100%"
      id="imagePreview"
      style="cursor:pointer;"
      @click="selectImage"
    />
    <p class="mt-5" v-if="image_upload_error">
      <span
        class="image-upload-error text-danger fz-15"
      >The minimum dimensions for your photo are 600 pixels x 600 pixels (height x width). The maximum dimensions are 1200 pixels x 1200 pixels (height x width).</span>
    </p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      image: "https://placehold.co/250x250?text=Upload Your Image",
      image_upload_error: ""
    };
  },
  methods: {
    selectImage(e) {
      e.preventDefault;
      e.stopPropagation;
      this.$refs.imageInput.click();
    },
    previewImage(e) {
      if (e.target.files && e.target.files[0]) {
        let fileReader = new FileReader();
        fileReader.onload = e => {
          let image = new Image();
          image.src = e.target.result;
          image.onload = uploadedImage => {
            if (
              uploadedImage.target.width >= 600 &&
              uploadedImage.target.width <= 1200 &&
              uploadedImage.target.height >= 600 &&
              uploadedImage.target.height <= 1200
            ) {
              this.image = e.target.result; //.("src", e.target.result);
              this.image_upload_error = false;
              this.$emit("input", this.image);
            } else {
              this.image_upload_error = true;
            }
          };
        };
        fileReader.readAsDataURL(e.target.files[0]);
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.img-thumbnail {
  max-width: 300px;
  max-height: 300px;
}
</style>