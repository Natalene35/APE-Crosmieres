<template>

    <div class="event--card">

        <router-link v-if="backOffice == false" v-bind:to="{ name: 'event', params: { id: id } }">
            <div class="event--card__media--image" v-bind:style="'background-image:url(' + image + ')'">
                <img v-on:click="del(id)" v-bind:src="trashPic" v-if="backOffice == true">
                <router-link class="event--card__editPic" v-if="backOffice == true"
                    v-bind:to="{ name: 'eventUpdate', params: { id: id } }">
                    <img v-bind:src="editPic">
                </router-link>

            </div>
            <h2 class="event--card__title">
                <div v-html="title"></div>
            </h2>
            <div class="event--card__content">
                <div v-html="content"></div>
            </div>
        </router-link>

        <div v-if="backOffice == true">
            <div class="event--card__media--image" v-bind:style="'background-image:url(' + image + ')'">


                <div class="event--backoffice__img">
                    <img v-on:click="del(id)" v-bind:src="trashPic" v-if="backOffice == true">
                    <router-link class="event--card__editPic" v-if="backOffice == true"
                        v-bind:to="{ name: 'eventUpdate', params: { id: id } }">
                        <img v-bind:src="editPic">
                    </router-link>
                </div>

            </div>
            <h2 class="event--card__title">
                <div v-html="title"></div>
            </h2>
            <div class="event--card__content">
                <div v-html="content"></div>
            </div>
        </div>

    </div>
</template>

<script>
import EventService from '@/services/events/EventService';
import trash from '@/assets/images/icons8-trash-can-100.png'
import edit from '@/assets/images/icons8-edit-100.png'

export default {
    name: "EventListLayout",
    emits: ["reloadEvent"],
    props: {
        image: String,
        title: String,
        content: String,
        id: Number,
        backOffice: Boolean
    },
    data() {
        return {
            trashPic: trash,
            editPic: edit,
        }
    },
    methods: {
        async del(e) {
            const response = await EventService.delete({
                "id": e
            });

            this.$emit("reloadEvent");
            console.log(response);
        },
    }
}

</script>

<style scoped lang="scss">
.event--card {
    border: 1px solid $white;
    border-radius: 2rem 2rem;
    background-color: $white;
    margin: 1%;
    display: flex;
    flex-direction: column;
    margin-bottom: 3rem;
    box-sizing: border-box;
    padding-bottom: 1rem;
    width: 95%;

    .event--card__title {
        color: $grey;
        font-weight: bold;
        padding-right: 2rem;
        padding-left: 2rem;
        font-size: 1.2rem;
        padding-top: 1rem;
    }

    .event--card__media--image {

        min-height: 30vh;
        background-position: center;
        background-size: cover;
        border-radius: 2rem 2rem 0 0;

        img,
        a {
            height: 4rem;
            position: absolute;
            right: 0;
            top: 0;
            cursor: pointer;
        }

        .event--card__media--image {

            min-height: 30vh;
            background-position: center;
            background-size: cover;
            border-radius: 2rem 2rem 0 0;

            .event--backoffice__img {
                display: flex;
                flex-direction: row-reverse;

                img,
                a {
                    height: 4rem;

                    cursor: pointer;
                }

                img:hover {
                    filter: brightness(1.1);
                    transform: scale(1.2);
                }
            }
        }
    }

    .event--card__content {
        color: $grey;
        margin: 1rem 3rem 1rem 3rem;

    }

}

//<---------------------MEDIA QUERIES ------------------------>
@media (max-width: 425px) {
    .event--card {
        width: 90%;
    }

}
</style>