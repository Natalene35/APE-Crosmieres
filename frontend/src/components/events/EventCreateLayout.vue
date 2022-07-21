<template>
  <section class="wrapper">
    <div class="container">
      <p class="error" v-for="error in errors" v-bind:key="error">
        {{ error }}
      </p>
      <p class="alert" v-if="alerts">
        {{ alerts }}
      </p>

      <div class="field">
        <label class="field__label">Titre de la publication </label>
        <input
          class="field__input"
          type="text"
          placeholder=""
          v-model="title"
        />

        <label class="field__label">Decription </label>
        <textarea
          class="textarea field__input"
          type="text"
          placeholder=""
          rows="3"
          v-model="content"
        ></textarea>

        <label class="field__label">Date de l'événement </label>
        <input
          class="field__input"
          type="date"
          placeholder=""
          v-model="eventDate"
        />

        <label class="field__label">Lieu de l'événement </label>
        <input
          class="field__input"
          type="text"
          placeholder=""
          v-model="location"
        />

        <label class="field__label"> Image </label>
        <input
          class="field__input"
          type="file"
          accept="image/*"
          ref="file"
          @change="selectImage"
        />

        <button class="btn btn-success btn-sm float-right" @click="submitForm">
          Soumettre
        </button>
      </div>

      <div v-if="currentImage" class="progress">
        <div
          class="progress-bar progress-bar-info"
          role="progressbar"
          :aria-valuenow="progress"
          aria-valuemin="0"
          aria-valuemax="100"
          :style="{ width: progress + '%' }"
        >
          {{ progress }}%
        </div>
      </div>

      <div v-if="previewImage">
        <div>
          <img
            class="preview my-3 img-thumbnail rounded"
            :src="previewImage"
            alt=""
          />
        </div>
      </div>

      <div v-if="(lastImage = imageInfos[0])">
        vous venez de télécharger l'image {{ lastImage.title.rendered }} avec
        l'id =
        {{ lastImage.id }}
      </div>
    </div>
  </section>
</template>

<script>
import EventService from "@/services/events/EventService";
export default {
  name: "EventCreateView",
  data() {
    return {
      title: null,
      content: null,
      eventDate: null,
      location: null,
      currentImage: undefined,
      previewImage: undefined,
      progress: 0,
      message: "",
      imageInfos: [],
      lastImage: {},
      errors: [],
      alerts: null,
    };
  },
  methods: {
    selectImage() {
      this.currentImage = this.$refs.file.files.item(0);
      this.previewImage = URL.createObjectURL(this.currentImage);
      this.progress = 0;
      this.message = "";
    },

    // upload and send to wordpress
    upload(postId) {
      this.progress = 0;

      EventService.upload(this.currentImage, this.title, postId, (event) => {
        this.progress = Math.round((100 * event.loaded) / event.total);
      })
        .then((response) => {
          this.message = response.data.message;
          return EventService.getFiles();
        })
        .then((images) => {
          this.imageInfos = images.data;
          // pour executer la fct createpost avec l'id du média
          let params = {
            featured_media: this.imageInfos[0].id,
          };
          console.log(params, this.imageInfos[0].id, postId);
          this.addMediaToEvent(postId, params);
        })
        .catch((err) => {
          this.progress = 0;
          this.message = "Could not upload the image! " + err;
          this.currentImage = undefined;
        });
    },

    // to submit fiels and send datas to custom post 'event'
    async submitForm() {
      // Reset error table
      this.errors = [];
      this.alerts = null;

      // Form Content Validation
      if (!this.title) {
        this.errors.push("Veuillez remplir un titre");
      }
      if (!this.content) {
        this.errors.push("Veuillez remplir une description");
      }
      if (!this.eventDate) {
        this.errors.push("Veuillez remplir une date");
      }
      if (!this.location) {
        this.errors.push("Veuillez remplir un lieu");
      }
      setTimeout(() => {
        this.errors = [];
      }, 5000);

      // Send form request if no error
      if (this.errors.length === 0) {
        let params = {
          title: this.title,
          content: this.content,
          date: this.eventDate,
          lieu: this.location,
        };
        const response = await EventService.addEvent(params);

        //post id
        console.log(response.data.id);
        this.upload(response.data.id);
        // this.alert.push("Evénement créé");
        // setTimeout(() => {
        //   this.alert = null;
        // }, 5000);

        // TODO : pour voir le résultat direct
        // setTimeout(() => this.$router.push({ name: "home" }), 500);
      }
    },
  },
  mounted() {
    EventService.getFiles().then((response) => {
      this.imageInfos = response.data;
    });
  },
};
</script>

<style lang="scss" scoped>
.wrapper {
  color: $grey;
  font-family: "Muli", sans-serif;
  font-size: 1rem;
  display: -ms-grid;
  display: grid;
  place-items: center;
  border-radius: 1em;

  .prevew {
    width: 50%;
  }
  .thumbnail {
    width: 150px;
    float: left;
  }

  .container {
    width: 80%;
    overflow: hidden;
    background-color: $white;
    margin-top: 1rem;
    margin-bottom: 1rem;
    border-radius: 1em;
    display: -ms-grid;
    display: grid;
    place-items: center;
    box-shadow: 0px 17px 34px -20px $blue-bg-header;
    .title {
      font-size: 1.6rem;
      font-weight: 700;
    }
    .field {
      padding: 1rem;
      margin: 1rem;
      display: flex;
      flex-wrap: wrap;
      width: 100%;
    }

    .field__label {
      width: 45%;
      float: left;
      margin: 0.5rem;
    }
    .field__input {
      padding: 0.5em 0 0.5em 1.5em;
      line-height: 3;
      border: 1px solid $blue-light-bg;
      border-radius: 0.5em;
      margin: 1rem 0 1rem 0;
      padding: 0;
      text-align: left;
      width: 45%;
      float: right;
      margin: 0.5rem;
    }

    ::placeholder {
      color: $red;
    }

    button {
      display: inline-block;
      width: 50%;
      font-size: 1.2rem;
      padding: 0.5em;
      margin: 0.2rem;
      margin-left: auto;
      margin-right: auto;
      border-radius: 5px;
      border: 1px solid #ffc107;
      box-shadow: 0 5px 5px #0000001a;
    }

    button:hover {
      color: white;
      background-color: #ffc107;
      box-shadow: 0 2px 2px #0000001a;
    }

    .error {
      background-color: lightcoral;
      font-weight: bold;
      width: 80%;
      margin: 0.5rem;
      margin-left: auto;
      margin-right: auto;
      border-radius: 5px;
      color: white;
    }
    .alert {
      background-color: lightblue;
      font-weight: bold;
      width: 90%;
      margin: 0.5rem;
      margin-left: auto;
      margin-right: auto;
      border-radius: 5px;
      color: Black;
    }
    // .title {
    //   font-size: 1.6rem;
    //   font-weight: 700;
    // }

    // .img {
    //   width: 100%;
    //   height: auto;
    //   border-radius: 1em 1em 0 0;
    //   object-fit: cover;
    //   transform: translateY(-26%);
    // }

    // .img--container {
    //   height: 200px;
    //   overflow: hidden;
    //   margin-bottom: 1.5em;
    // }

    // .title {
    //   margin-bottom: 0.9em;
    // }

    // .content {
    //   display: -ms-grid;
    //   display: grid;
    //   place-items: center;
    //   padding: 0 2em;
    // }

    // .inputbox {
    //   padding: 0.5em 0 0.5em 1.5em;
    //   line-height: 3;
    //   width: 100%;
    //   border: 1px solid $blue-light-bg;
    //   border-radius: 0.5em;
    //   margin: 1rem 0 1rem 0;
    //   padding: 0;
    //   text-align: center;
    // }

    // ::placeholder {
    //   color: $red;
    // }

    // .subscribe {
    //   color: $white;
    //   font-size: 1.3rem;
    //   font-weight: 700;
    //   background-color: $red;
    //   padding: 0.9em 0;
    //   display: inline-block;
    //   border: none;
    //   border-radius: 0.5em;
    //   width: 100%;
    //   margin-bottom: 1.3em;
    //   cursor: pointer;
    // }

    // .push--message {
    //   color: $red;

    //   p {
    //     margin-bottom: 0.5rem;
    //   }
    // }
  }

  @media (max-width: 425px) {
    .container {
      background-color: transparent;
      box-shadow: none;
      border-radius: none;

      .img--container {
        border-radius: none;
      }
    }
  }
}
</style>