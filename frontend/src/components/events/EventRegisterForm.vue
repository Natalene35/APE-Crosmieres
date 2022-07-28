<template>
  <div class="wrapper">
    <div class="container">
      <h1>s'inscrire à l'événement</h1>
      <button>Je m'inscris</button>
      <div class="link--case">
        <img
          src="../../assets/images/jelly-character-gets-a-printed-document.png"
          alt=""
        />
        <a
          class="download"
          href="Document URL"
          attributes-list
          download="optional-value"
        >
          Link Text
        </a>
      </div>
      <a
        class="download"
        href="../assets/documents/Inscription.pdf"
        download="fiche d'inscription"
      >
      </a>

      <a class="download" href="dosfiles.pdf" download="file">
        <b> download </b>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: "EventRegisterForm",
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
    .link--case {
      height: 50%;
      background-color: blue;
      img {
        display: inline;
        float: left;
      }
      .download {
        height: 10%;
        background-color: #ffc107;
        margin: 1rem;
        display: inline;
      }
    }
  }
}
</style>