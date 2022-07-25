<template>
    <div id="child_form">
        <label class="field--child__label">Nom et classe de votre enfant ?</label>
        <input v-model="child.child_name" type="text" class="inputbox" placeholder="Nom de votre enfant"
            name="child_name">
        <div class="field--room_label">
            <input type="radio" id="CP" value="CP" v-model="childchild_room" />
            <label for="CP">CP</label>
            <input type="radio" id="CM1" value="CM1" v-model="child_room" />
            <label for="CM1">CM1</label>
            <input type="radio" id="CM2" value="CM2" v-model="child_room" />
            <label for="CM2">CM2</label>
            <input type="radio" id="CE1" value="CE1" v-model="child_room" />
            <label for="CE1">CE1</label>
            <input type="radio" id="CE2" value="CE2" v-model="child_room" />
            <label for="CE2">CE2</label>
            <button v-on:click="addChild">Ajouter un enfant</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "ChildRegistrationLayout",

    data() {
        return {
            child_name: null,
            child_room: null,
            child: [],
        }
    },

    methods: {
        addChild() {
            this.child.push({
                "child name": this.child_name,
                "child_room": this.child_room
            });
        }
    }

}

</script>

<style scoped lang="scss">
.inputbox {
    margin: 1rem;
}

.field--room_label {
    margin-bottom: 1rem;
}
</style>