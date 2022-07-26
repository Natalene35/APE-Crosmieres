<template>
  <section class="wrapper">
    <div class="container">
      <div class="card">
        <p class="name">Emilie</p>
        <img
          class="logo--img"
          src="../../assets/images/jelly-message-sent-by-character.png"
          alt=""
        />
        <h1 class="title">Scrum Master</h1>
        <p class="content">
          Son surnom 'El presidente', ce n'est pas pour rien. Respecter et
          craint à la fois, elle fait regner l'ordre autour d'elle.
        </p>
      </div>

      <div class="card">
        <p class="name">Natalène</p>
        <img
          class="logo--img"
          src="../../assets/images/jelly-message-sent-by-character.png"
          alt=""
        />
        <h1 class="title">Git Master</h1>
        <p class="content">
          comme son titre l'indique, elle est passé maitre dans le Git. Après
          des années d'entrainement et de commit, elle a réussi intégrée la
          matrice de Git.
        </p>
      </div>

      <div class="card">
        <p class="name">Damien</p>
        <img
          class="logo--img"
          src="../../assets/images/jelly-message-sent-by-character.png"
          alt=""
        />
        <h1 class="title">Lead Dev Front</h1>
        <p class="content">
          Les display flex, grid, inline n'ont plus de secret pour lui. Il créé
          des animations au p'tit dej, c'est no problemo. Guidé par son calme
          olympien, il mets tout le monde d'accord.
        </p>
      </div>

      <div class="card">
        <p class="name">Julien</p>
        <img
          class="logo--img"
          src="../../assets/images/jelly-message-sent-by-character.png"
          alt=""
        />
        <h1 class="title">Lead Dev Back</h1>
        <p class="content">
          Une ruelle sombre, l'heure du crime, il n'est jamais très loin. Guidé
          par les esprits de la nuit, il code la ou personne ne mets les pieds.
          Parti dans les méhandres du back, personnes ne l'a jamais revu...
        </p>
      </div>

      <div class="card">
        <p class="name">Christophe</p>
        <img
          class="logo--img"
          src="../../assets/images/jelly-message-sent-by-character.png"
          alt=""
        />
        <h1 class="title">Product Owner</h1>
        <p class="content">
          Celui que tout le monde redoute. "le bouton est trop gros", "la
          couleurs doit être plus jaune", "ajoute un espace". "relou un jours,
          relou toujours" tel est sa devise.
        </p>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "MemberLayout",

  data() {
    return {};
  },

  methods: {},
};
</script>


<style lang="scss" scoped>
.wrapper {
  color: $grey;
  font-family: "Muli", sans-serif;
  font-size: 1rem;
  place-items: center;
  border-radius: 1em;

  .container {
    width: 100%;
    height: 100%;
    overflow: hidden;
    background-color: $white;
    margin-top: 0.5rem;
    margin-bottom: 1rem;
    border-radius: 1em;
    display: -ms-grid;
    display: flex;
    place-items: center;
    box-shadow: 0px 17px 34px -20px $blue-bg-header;

    .card {
      border-radius: 1em;
      height: 80%;
      margin: 0.5rem;
      padding: 0.5rem;
      display: flex;
      flex-wrap: wrap;
      box-shadow: 0px 17px 34px -20px $blue-bg-header;
      width: 100%;

      .name {
        width: 100%;
        text-align: center;
        font-weight: bold;
      }
      .content {
        height: 40%;
      }
      .preview {
        width: 50%;
        border-radius: 5px;
        border: thick double gray;
        box-shadow: 0px 17px 34px -20px $blue-bg-header;
        margin-bottom: 1rem;
      }
      .logo--img {
        margin: auto;
        width: 100%;
      }
      .title {
        font-size: 1.6rem;
        font-weight: 700;
        text-align: center;
        padding: 1rem;
        margin-bottom: 1rem;
      }
      .field__title {
        width: 100%;
        margin-left: auto;
        margin-right: auto;
      }
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