<template>
    <div class="container">
        <form v-on:submit.prevent>
<!--            method="POST" action="./api/projects" v-on:submit.prevent-->
            <div class="modal is-active" v-show="openNewPrForm">


                <div class="modal-background"></div>
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">New Project</p>
                        <button class="delete" aria-label="close" @click="openNewPrForm = false"></button>
                    </header>
                    <section class="modal-card-body">
                        <input type="text" class="input is-info" name="project_name" id="project_name"
                               placeholder="Project name"
                               v-model="projectName">

                    </section>
                    <footer class="modal-card-foot">
                        <button class="button is-success" v-if="this.projectName != ''" @click="newProject">Save
                        </button>

                    </footer>
                </div>

            </div>
        </form>
        <ul style="text-align: left">
            For createing a new project click the button below<br>
            <button @click="openNewPrForm = true" class="button is-info">Create</button>
        </ul>

    </div>

</template>

<script>
    export default {

        data() {
            return {
                openNewPrForm: false,
                projectName: '',
            }

        },

        methods: {

            async newProject() {
                try {
                    const response = await axios.post('./api/projects', {
                        projectName: this.projectName
                    });
                    Swal.fire("Radis li");
                } catch (e) {
                    Swal.fire("Ne radim");
                } finally {
                    this.projectName = '';
                    this.openNewPrForm = false;
                }
            },
        }
    }
</script>

