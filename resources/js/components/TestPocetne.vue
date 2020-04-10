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
                    <select v-model="projectId" @change="fetchUsers">
                        <option>Select dropdown</option>
                        <option :value="p.id" v-for="p in projects">{{p.name}}</option>

                    </select>
                </div>
            </div>
        </div>

        <div v-show="projectId != 'Select dropdown'">


            <table class="table is-narrow">

                <tr><td><newjson></newjson></td><td> <translate></translate></td></tr>
            </table>

           <!-- <div class="container">
                <div class="notification">


            <div class="columns">
                <div class="column is-one-third" style="text-align: center; border: 1px solid black">
                    <h1 class="subtitle is-5">Team</h1>
                    <div v-for="user in usersOnProject" :key="user.id">
                        <p>{{ user.name }}</p>


                    </div>

                </div>
                <div class="column" style="text-align: center;  border: 1px solid black"><h1 class="subtitle is-5">Translated JSON files</h1></div>

            </div>


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
                projectId: 'Select dropdown',
                usersOnProject: [],
                id: 1
            }
        },

        methods: {
            async newProject() {
                try {
                    const response = await axios.post('./api/projects', {
                        name: this.projectName
                    });
                    this.fetchProjects();
                    Swal.fire("Successfully added a new project");
                } catch (e) {
                    Swal.fire("Oops, something went wrong, try gain in a few seconds");
                } finally {
                    this.projectName = '';
                    this.openNewPrForm = false;
                }
            },
            async fetchProjects() {
                try {
                    const {data} = await axios.get('/api/projects');
                    this.projects = data;
                } catch {
                    Swal.fire({icon: 'error', text: 'Cannot fetch projects at the moment, try again later.'});
                }
            },
            async fetchUsers(){
                try {
                    const {data} = await axios.get(`/api/projects/${this.projectId}/users`);
                    this.usersOnProject = data;
                }catch  {

                }
            }

        },
        created() {
            this.fetchProjects();
        }
    }
</script>

