<template>
    <footer>
        <ul class="footer--list">
            <li class="footer--list__link">Facebook</li>
            <li class="footer--list__link">Nous contacter</li>
            <li class="footer--list__link">
                <router-link v-bind:to="{ name: 'legals-mentions' }" class="link">
                    Mentions légales
                </router-link>
            </li>
        </ul>

    </footer>
</template>


<script>
export default {
    name: 'FooterLayout',
}
</script>


<style lang="scss">
footer {
    background-color: $blue-bg-header;
    height: 4rem;
    font-weight: bold;
    font-size: small;
    border-radius: 10px 10px;

    .footer--list {
        display: flex;
        list-style-type: none;
        padding-top: 0.7rem;

        li {
            width: 48%;
            height: 100%;
            margin: 1%;
            cursor: pointer;
            display: inline-block;
            position: relative;
        }

        a {
            color: $white;
        }

        //WE USE THE underlineAnim.scss for animate footer li  
        @import "@/assets/animations/underlineAnim.scss";
    }
}

//MEDIA QUERIES 
@media (max-width: 425px) {
    footer {
        margin: 0;
        margin-top: 2%;


        li:after {
            display: none;

        }
    }
}
</style>