<template>
  <section class="wrapper">
    <div class="container">
      <div class="field">
        <div class="field__title">
          <img
            class="logo--img"
            src="../../assets/images/jelly-message-sent-by-character.png"
            alt=""
          />
          <h1 class="title">Ajout d'un événement</h1>
        </div>

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
        <p class="error" v-for="error in errors" v-bind:key="error">
          {{ error }}
        </p>
        <p class="alert" v-if="alerts">
          {{ alerts }}
        </p>
        <button class="btn btn-success btn-sm float-right" @click="submitForm">
          Soumettre
        </button>
      </div>

      <div v-if="currentImage" class="progress">
        <div
          class="progress-bar"
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
          <img class="preview" :src="previewImage" alt="" />
        </div>
      </div>
    </div>
    <p style="visibility: hidden">
      Illustration by
      <a href="https://icons8.com/illustrations/author/541847"
        >Murat Kalkavan</a
      >
      from <a href="https://icons8.com/illustrations">Ouch!</a>
    </p>
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
      imageInfos: [],
      errors: [],
      alerts: null,
    };
  },
  methods: {
    selectImage() {
      this.currentImage = this.$refs.file.files.item(0);
      this.previewImage = URL.createObjectURL(this.currentImage);
      this.progress = 0;
    },

    // upload and send to wordpress
    upload(postId) {
      this.progress = 0;

      EventService.upload(this.currentImage, this.title, postId, (event) => {
        this.progress = Math.round((100 * event.loaded) / event.total);
      })
        .then(() => {
          return EventService.getFiles();
        })
        .then((images) => {
          this.imageInfos = images.data;
          // pour executer la fct createpost avec l'id du média
          EventService.addMediaToEvent(postId, this.imageInfos[0].id).then(
            (response) => {
              if (response.status === 200) {
                this.title = null;
                this.content = null;
                this.eventDate = null;
                this.location = null;
                this.currentImage = undefined;
                this.previewImage = undefined;
                this.progress = 0;
                this.alerts = "Evénement créé";
                //redirection vers la home
                setTimeout(() => this.$router.push({ name: "home" }), 1500);
              } else {
                this.errors.push(
                  "Erreur d'enregistrement, veuillez verifier la présence de l'image dans l'événement"
                );
              }
            }
          );
        })
        .catch((err) => {
          this.progress = 0;
          this.errors.push("Erreur sur le chargement de l'image !");
          this.errors.push("L'événement a été crée sans l'image");
          this.errors.push(
            "Veuillez modifier dans la page de modification d'événement svp."
          );
          console.log(err);
          this.currentImage = undefined;
        });
    },

    // to submit fields and send datas to custom post 'event'
    async submitForm() {
      // Reset error table
      this.errors = [];
      this.alerts = null;

      // Form Content Validation
      if (!this.title) {
        this.errors.push("Veuillez remplir un titre svp");
      }
      if (!this.content) {
        this.errors.push("Veuillez remplir une description svp");
      }
      if (!this.eventDate) {
        this.errors.push("Veuillez remplir une date svp");
      }
      if (!this.location) {
        this.errors.push("Veuillez remplir un lieu svp");
      }
      if (!this.currentImage) {
        this.errors.push("Veuillez choisir une image svp");
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
          post_status: "publish",
        };

        const response = await EventService.addEvent(params);

        if (response) {
          //response.data.id is the post id
          this.upload(response.data.id);
        } else {
          this.errors.push(
            "Erreur d'enregistrement de l'événement ! Veuillez verifier la présence de l'événement"
          );
        }
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

  .container {
    width: 80%;
    overflow: hidden;
    background-color: $white;
    margin-top: 0.5rem;
    margin-bottom: 1rem;
    border-radius: 1em;
    display: -ms-grid;
    display: grid;
    place-items: center;
    box-shadow: 0px 17px 34px -20px $blue-bg-header;

    .progress {
      width: 50%;
      border-radius: 1rem;
      background-color: #ffc107;
      height: 1rem;
      color: aliceblue;
      font-weight: bold;
      padding: 0.2rem;
      margin-bottom: 1rem;
    }
    .progress-bar {
      border-radius: 1rem;
      background-color: aquamarine;
      height: 1rem;
      background: repeating-linear-gradient(
          -60deg,
          rgb(0, 0, 0, 0.5) 0,
          black 10px,
          #ffc107 10px,
          white 20px
        )
        0 / 200%;
      animation: progress-bar 1s linear infinite;
    }
    @keyframes progress-bar {
      to {
        background-position: 100% 0;
      }
    }

    .preview {
      width: 50%;
      border-radius: 5px;
      border: thick double gray;
      box-shadow: 0px 17px 34px -20px $blue-bg-header;
      margin-bottom: 1rem;
    }

    .field {
      padding: 1rem;
      margin: 1rem;
      display: flex;
      flex-wrap: wrap;
      align-items: baseline;
      width: 100%;

      .field__title {
        width: 100%;
        margin-left: auto;
        margin-right: auto;

        .logo--img {
          display: none;
        }
        .title {
          font-size: 1.6rem;
          font-weight: 700;
          text-align: center;
          padding: 1rem;
          margin-bottom: 1rem;
        }
      }
      .field__label {
        width: 45%;
        float: left;
        margin: 0.5rem;
      }
      .field__input {
        line-height: 3;
        border: 1px solid $blue-light-bg;
        border-radius: 0.5em;
        margin: 1rem 0 1rem 0;
        padding: 0.5em 0 0.5em 1.5em;
        text-align: left;
        width: 45%;
        float: right;
      }

      ::placeholder {
        color: $red;
      }

      .error {
        background-color: lightcoral;
        font-weight: bold;
        width: 80%;
        padding: 0.2rem;
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
        padding: 0.2rem;
        margin: 0.5rem;
        margin-left: auto;
        margin-right: auto;
        border-radius: 5px;
        color: Black;
      }
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
  }

  @media (max-width: 600px) {
    .container {
      background-color: transparent;
      box-shadow: none;
      border-radius: none;

      .field {
        padding: 1rem;
        margin: 1rem;
        display: flex;
        flex-wrap: wrap;
        width: 100%;

        .field__title {
          .logo--img {
            display: inline;
            width: 60%;
            margin-left: auto;
            margin-right: auto;
          }
        }
        .field__label {
          width: 100%;
        }
        .field__input {
          width: 100%;
        }
      }
    }
  }
}
</style>