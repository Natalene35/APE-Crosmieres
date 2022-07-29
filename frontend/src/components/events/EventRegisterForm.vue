<template>
  <div class="wrapper">
    <div class="container">
      <h1>s'inscrire à l'événement</h1>

      <div class="link--case">
        <a
          class="download"
          href="@/assets/documents/Inscription.pdf"
          download="Inscription.pdf"
        >
          <b> fiche d'inscription </b>
          <img
            src="../../assets/images/jelly-character-gets-a-printed-document.png"
            alt=""
          />
        </a>
      </div>

      <div class="alert-error">
        <span>Something went wrong! Please try again.</span>
      </div>

      <div class="alert-success">
        <span>Message Sent! Thank you for contacting us.</span>
      </div>

      <!--contact section start-->
      <div class="contact-section">
        <div class="contact-form">
          <h2>Contact Us</h2>
          <form class="contact" action="" method="post">
            <input
              type="text"
              name="name"
              class="text-box"
              placeholder="Your Name"
              required
            />
            <input
              type="email"
              name="email"
              class="text-box"
              placeholder="Your Email"
              required
            />
            <input type="submit" name="submit" class="send-btn" value="Send" />
          </form>
        </div>
      </div>
      <!--contact section end-->

      <button type="button" onclick="sendEmail()" value="Send An Email">
        Je m'inscris
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "EventRegisterForm",
  method: {},
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

    .contact-section {
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;

      .contact-form {
        max-width: 700px;
        margin-right: 50px;
        flex: 1;

        h2 {
          color: #fff;
          text-align: center;
          font-size: 35px;
          text-transform: uppercase;
          margin-bottom: 30px;
        }

        .text-box {
          background: #000;
          color: #fff;
          border: none;
          width: calc(50% - 10px);
          height: 50px;
          padding: 12px;
          font-size: 15px;
          border-radius: 5px;
          box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
          margin-bottom: 20px;
          opacity: 0.9;
        }

        .text-box:first-child {
          margin-right: 15px;
        }

        textarea {
          background: #000;
          color: #fff;
          border: none;
          width: 100%;
          padding: 12px;
          font-size: 15px;
          min-height: 200px;
          max-height: 400px;
          resize: vertical;
          border-radius: 5px;
          box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
          margin-bottom: 20px;
          opacity: 0.9;
        }

        .send-btn {
          float: right;
          background: #2e94e3;
          color: #fff;
          border: none;
          width: 120px;
          height: 40px;
          font-size: 15px;
          font-weight: 600;
          text-transform: uppercase;
          letter-spacing: 2px;
          border-radius: 5px;
          cursor: pointer;
          transition: 0.3s;
          transition-property: background;
        }

        .send-btn:hover {
          background: #0582e3;
        }
      }
      @media screen and (max-width: 950px) {
        .container {
          background-color: transparent;
          box-shadow: none;
          border-radius: none;

          .contact-form {
            margin: 30px 50px;

            h2 {
              font-size: 30px;
            }

            .text-box {
              width: 100%;
            }
          }
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
}
</style>