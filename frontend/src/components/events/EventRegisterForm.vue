<template>
  <div class="wrapper">
    <div class="container">
      <h1 class="title">s'inscrire à l'événement</h1>

      <div class="download">
        <a
          class="download__link"
          href="./../assets/documents/Inscription.pdf"
          download="Inscription.pdf"
        >
          <b> Télécharger la fiche d'inscription </b>
        </a>
        <img
          class="download__icon"
          src="../../assets/images/jelly-character-gets-a-printed-document.png"
          alt=""
        />
      </div>

      <div class="field">
        <input
          type="text"
          v-model="name"
          class="field__input"
          placeholder="Votre nom"
        />
        <input
          type="email"
          v-model="email"
          class="field__input"
          placeholder="Votre adresse email"
        />
        <textarea
          class="field__input"
          v-model="subject"
          rows="2"
          placeholder="Sujet"
        ></textarea>
        
        <button @click="submitForm">Je m'inscris</button>
      </div>

      <p class="alert-error" v-for="error in errors" v-bind:key="error">
        {{ error }}
      </p>
      <p class="alert-success" v-if="alerts">
        {{ alerts }}
      </p>
    </div>
  </div>
</template>

<script>
import UserService from "@/services/user/UserService";

export default {
  name: "EventRegisterForm",
  data() {
    return {
      name: null,
      email: null,
      subject: null,
      file: null,
      errors: [],
      alerts: null,
    };
  },
  methods: {
    // to submit fields and send datas to custom post 'event'
    async submitForm() {
      setTimeout(() => {
        this.alert = "c'est parti";
      }, 5000);

      // Reset error table
      this.errors = [];
      this.alerts = null;
      // Form Content Validation
      if (!this.name) {
        this.errors.push("Veuillez remplir un titre svp");
      }
      if (!this.email) {
        this.errors.push("Veuillez remplir une description svp");
      }
      if (!this.subject) {
        this.errors.push("Veuillez remplir une date svp");
      }

      setTimeout(() => {
        this.errors = [];
      }, 5000);
      // Send form request if no error
      if (this.errors.length === 0) {
        let params = {
          name: this.name,
          email: this.email,
          subject: this.subject,
        };
        const response = await UserService.sendEmail(params);

        if (response) {
          this.name = null;
          this.email = null;
          this.subject = null;
          this.alerts = "Email envpyé";
          // home redirect
          setTimeout(() => this.$router.push({ name: "home" }), 1500);
        } else {
          this.errors.push(
            "Une erreur s'est produite, veuillez réessayer plus tard..."
          );
        }
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.wrapper {
  color: $grey;
  font-family: "Muli", sans-serif;
  font-size: 1rem;
  border-radius: 1em;

  display: flex;
  justify-content: center;
  align-items: center;

  .container {
    width: 90%;
    overflow: hidden;
    background-color: $white;
    margin-top: 0.5rem;
    margin-bottom: 1rem;
    border-radius: 1em;
    box-shadow: 0px 17px 34px -20px $blue-bg-header;

    .title {
      font-size: 1.6rem;
      font-weight: 700;
      text-align: center;
      padding-top: 1rem;
    }

    .alert-success {
      z-index: 1;
      background: #d4edda;
      font-size: 18px;
      padding: 20px 40px;
      min-width: 420px;
      position: fixed;
      right: 0;
      top: 10px;
      border-left: 8px solid #3ad66e;
      border-radius: 4px;
    }

    .alert-error {
      z-index: 1;
      background: #fff3cd;
      font-size: 18px;
      padding: 20px 40px;
      min-width: 420px;
      position: fixed;
      right: 0;
      top: 10px;
      border-left: 8px solid #ffa502;
      border-radius: 4px;
    }

    .download {
      width: 50%;
      margin: auto;
      display: flex;
      justify-content: center;
      align-items: center;

      .download__link {
        color: black;
        font-weight: bold;
        margin: 1rem auto;

        b:before {
          content: ">>";
        }

        b:after {
          content: "<<";
        }
      }
      .download__icon {
        width: 15vw;
        margin: -1rem auto;
      }
    }

    max-width: 100%;

    .field {
      margin: auto;
      display: flex;
      flex-wrap: wrap;
      align-items: baseline;
      width: 100%;

      .title {
        font-size: 1.6rem;
        font-weight: 700;
        text-align: center;
        padding: 1rem;
        margin-bottom: 1rem;
      }

      .field__label {
        width: 100%;
        float: left;
        margin: 0.5rem;
      }

      .field__input {
        line-height: 3;
        border: 1px solid $blue-light-bg;
        border-radius: 0.5em;
        margin: 0.5rem auto;
        padding: 0.2rem 1rem;
        text-align: left;
        width: 60%;
        float: right;
      }

      ::placeholder {
        color: $red;
      }

      button {
        display: inline-block;
        width: 50%;
        font-size: 1.2rem;
        padding: 0.5em;
        margin: 1rem;
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
  }
  @media screen and (max-width: 950px) {
    .container {
      background-color: transparent;
      box-shadow: none;
      border-radius: none;
      .download {
        width: 70%;
        flex-direction: column-reverse;

        .download__icon {
          width: 55vw;
        }
      }
      .form {
        .field {
          display: flex;
          flex-wrap: wrap;
          flex-direction: column;
          align-items: baseline;
          width: 100%;

          .field__input {
            line-height: 3;
            border: 1px solid $blue-light-bg;
            border-radius: 0.5em;
            margin: 0.5rem auto;
            padding: 0.2rem 1rem;
            text-align: left;
            width: 80%;
            float: right;
          }
        }
      }
    }
  }
}
</style>