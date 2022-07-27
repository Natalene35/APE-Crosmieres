<template>
  <section class="wrapper">
    <div class="container">
      <div class="field">
        <div class="field__title" v-if="this.active!=null">
          <img
            class="logo--img"
            src="../../assets/images/jelly-message-sent-by-character.png"
            alt=""
          />
        </div>

        <label class="field__label">Titre </label>
        <input
          class="field__input"
          type="text"
          placeholder=""
          v-model="title"
        />

        <label class="field__label">Description </label>
        <textarea
          class="textarea field__input"
          type="text"
          placeholder=""
          rows="3"
          v-model="content"
        ></textarea>
  <!-- //ADD CONTAINER FOR DATE/LIEU  -->
    <div class="field--container__date">
        <label class="field__label ">Date</label>
        <input
          class="field__input date"
          type="date"
          placeholder=""
          v-model="eventDate"
        />
        <label class="field__label">Lieu </label>
        <input
          class="field__input lieu"
          type="text"
          placeholder=""
          v-model="location"
        />
    </div>
        
<!-- //ADD CONTAINER FOR UPLOAD IMAGE/BUTTON/SEE IMAGE -->
      <div class="field--container__last">
        <!-- //IMAGE UPLOAD -->
        <label class="field__label"> Image </label>
        <div class="field__img--container">
          <input
            class="field__input"
            type="file"
            accept="image/*"
            ref="file"
            @change="selectImage"
          />
          <div class="field__img" v-bind:style="{ 'background-image': 'url(' + this.image + ')' }" ></div>
        </div>
        <!-- //PREVIEW IMAGE -->
        <div class="field__preview--container">
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
          <div v-if="this.imgSelectEvent!=null">
            <div>
              <div v-bind:style="'background-image:url(' + imgSelectEvent + ')'"> </div>
            </div>
          </div>
        </div>
          
      <!-- //BUTTON -->
        <button class="btn btn-success btn-sm float-right" @click="submitForm">
          Soumettre
        </button>
      </div>
        
          
        <p class="error" v-for="error in errors" v-bind:key="error">
          {{ error }}
        </p>
        <p class="alert" v-if="alerts">
          {{ alerts }}
        </p>
        
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
  props: {
        active: String,
    },
  data() {
    
    return {
      //FIELD FORM CRUD //
      title: null,
      content: null,
      place: null,
      date: null,
      link: null,
      eventDate: null,
      location: null,
      currentImage: undefined,
      previewImage: undefined,
      progress: 0,
      imageInfos: [],
      errors: [],
      alerts: null,
      selectEvent: null,
      selectPostMeta: null,
      image: null,
      imgSelectEvent: null,
      
    };
  },
  methods: {
    selectImage() {
      console.log("entree select img "+this.$refs.file.files.item(0))
      this.currentImage = this.$refs.file.files.item(0);
      this.previewImage = URL.createObjectURL(this.currentImage);
      this.progress = 0;
    },

    // upload and send to wordpress
    upload(postId) {
      console.log("le postID est de "+postId)
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
                // //redirection vers la home
                // setTimeout(() => this.$router.push({ name: "home" }), 1500);
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

    // to submit fiels and send datas to custom post 'event'
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
        };

        const response = await EventService.addEvent(params);
        console.log("ici le bug "+response.data.id)
         //UPDATE POST FOR TAKE IT PUBLISH
            const majPost = await EventService.update({
                "status": "publish",
                "id": response.data.id
            });
             this.$emit("reloadEv");
            console.log(response.data.id+majPost)
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
  async mounted() {
    EventService.getFiles().then((response) => {
      this.imageInfos = response.data;
    });

    //this.active contains ID of the SELECT Event
    if(this.active!=null){
        this.selectEvent=await EventService.find(parseInt(this.active))
        console.log("event selectionné est "+this.selectEvent._embedded['wp:featuredmedia'][0].source_url)
        this.image=this.selectEvent._embedded['wp:featuredmedia'][0].source_url 
        this.title = this.selectEvent.title.rendered;
        this.content = this.selectEvent.content.rendered;
        this.selectPostMeta= await EventService.findMeta(this.active);
        for(const meta of this.selectPostMeta){
            if(meta.meta_key=="date"){
                this.eventDate =  meta.meta_value
            }
            if(meta.meta_key=="lieu"){
                this.location =  meta.meta_value
            }
        }
        
    }    
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
  height: 90%;

  .container {
    width: 100%;
    margin-top: 0.5rem;
    margin-bottom: 1rem;
    display: -ms-grid;
    display: grid;
    place-items: center;

    .progress {
      width: 6%; 
      border-radius: 1rem;
      background-color: #ffc107;
      color: aliceblue;
      font-weight: bold;
      padding: 0.2rem;
      padding-left: 0%;
      height: 76%;
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
    border-radius: 5px;
    border: thick double gray;
    box-shadow: 0px 17px 34px -20px #46bfc7;
    max-height: 18vh;
    }

    .field {
      display: flex;
      flex-wrap: wrap;
      width: 100%;
      position: relative;
      z-index: 10;
    

      .field__title {
        height: 10vh;
        position: absolute;
        top: -28%;
        display: flex;

        .logo--img {
          height: inherit;
          left: 0;
        }
        .title {
          font-size: 1.6rem;
          font-weight: 700;
          text-align: center;
          padding: 1rem;
          margin-bottom: 1rem;
        }
      }
      //ADD NEW CLASS EMPLACEMENT
      .field--container__date{
        display: flex;
        width: 100%;
        .lieu {
          width: 40%;
        }
        .date{
          width: 100px;
          padding-right: 1%;
        }
        
      }
      .field--container__last{
        width: 100%;
        display: flex;
        .field__label {
        width: 15%;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-style: italic;
      }
      .field__img--container{
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 16%;
        .field__input {
          line-height: 2;
          border: 1px solid $blue-light-bg;
          border-radius: 0.5em;
          margin: 1rem 0 1rem 0;
          padding: 0.5em 0 0.5em 1.5em;
          text-align: left;
          width: 75%;
          float: right;
          border: unset;
          margin: 0;
          width: fit-content;
          box-shadow: unset;
        }
      }
      .field__preview--container{
        display: flex;
        align-items: center;
        justify-content: center;
        align-content: center;
      }
      .field__img{
        background-position: center;
        height: 153%;
        background-size: contain;
        background-repeat: no-repeat;
        height: 15vh;
        width: 15vh;
      }
      .button{
        width: 30%;
      }
      }
      .field__label {
        width: 15%;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;

      }
      .field__input {
        line-height: 2;
        border: 1px solid $blue-light-bg;
        border-radius:10%;
        margin: 1rem 0 1rem 0;
        padding: 0.5em 0 0.5em 1.5em;
        text-align: left;
        width: 75%;
        float: right;
        box-shadow:  -6px -6px 1px $blue-bg-header;
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
    width: 13%;
    font-size: 1.2rem;
    padding: 0.5em;
    margin: 0.2rem;
    margin-left: auto;
    margin-right: auto;
    border-radius: 5px;
    border: 1px solid #ffc107;
    box-shadow: -5px -4px 5px rgb(0 0 0 / 40%);
    position: absolute;
    right: 6%;
    min-width: 11VH;
    display: flex;
    bottom: 10%;
    justify-content: center;
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