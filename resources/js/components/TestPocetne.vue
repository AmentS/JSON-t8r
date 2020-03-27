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
        <br>

        Project you are already a part of:<br>
        <div class="field">
            <div class="control">
                <div class="select is-small is-success">
                    <select v-model="projectId">
                        <option>Select dropdown</option>
                        <option :value="p.id" v-for="p in projects">{{p.project_name}}</option>

                    </select>
                </div>
            </div>
        </div>

     <div v-show="projectId != 'Select dropdown'">

        <newjson></newjson>
         <translate></translate>

        </div>

    </div>

</template>

<script>


    import Newjson from "./Newjson";
    import Translate from "./Translate.vue";
    export default {
        components: {Newjson, Translate},

        data() {
            return {
                openNewPrForm: false,
                projectName: '',
                projects: [],
                projectId: 'Select dropdown'
            }

        },

        methods: {

            async newProject() {
                try {
                    const response = await axios.post('./api/projects', {
                        projectName: this.projectName
                    });
                    Swal.fire("Successfully added a new project");
                } catch (e) {
                    Swal.fire("Oops, something went wrong, try gain in a few seconds");
                } finally {
                    this.projectName = '';
                    this.openNewPrForm = false;
                }
            }

        },
        created() {

            axios.get('./api/projects').then(({data}) => this.projects = data);

        }
    }
</script>

