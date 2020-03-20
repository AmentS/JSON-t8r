<template>
    <div class="container">
        <div class="modal is-active" v-show="showModal">
                <div class="modal-background"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Support contact sheet</p>
                        <button class="delete" aria-label="close" @click="showModal = false"></button>
                    </header>
                    <section class="modal-card-body">
                        Problem:
                        <input type="text" class="input is-info" name="problem" id="problem">
                        Description:
                        <textarea name="description" id="description" cols="83" rows="10" class="textarea is-info"></textarea>
                    </section>
                    <footer class="modal-card-foot">
                        <button class="button is-success">Send</button>

                    </footer>
                </div>
            </div>
        <ul style="text-align: left">
            For contacting our admins please click the button below <br>
            <button @click="showModal = true" class="button is-info">Contact</button>
        </ul>

    </div>
</template>

<script>
    export default {

        data(){
            return{
                showModal: false,
            }
        }

    }
</script>