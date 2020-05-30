<template>
    <div class="container">
        <form v-on:submit.prevent>

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
                    <select v-model="projectId" @change="fetchUsers(); fetchTranslations()">
                        <option>Select dropdown</option>
                        <option :value="p.id" v-for="p in projects">{{p.name}}</option>

                    </select>
                </div>
            </div>
        </div>

        <div v-show="projectId != 'Select dropdown'">
            <div style="margin-bottom: 10px">
                <label class="label">Add person to project:</label>
                <input type="email" placeholder="example@exapmle.com" class="input is-info" style="width: 25%" v-model="userEmail">
                <button class="button is-success is-light" @click="addUserToProject">Add</button>
            </div>

            <table class="table is-narrow">

                <tr><td><newjson :projectId="projectId"></newjson></td><td> <translate :projectId="projectId"></translate></td></tr>
            </table>



            <div class="columns">
                <div class="column is-one-third" style="text-align: center;">
                    <h1 class="subtitle is-5">Team</h1>
                    <table class="table table is-striped">
                        <tr v-for="user in usersOnProject" :key="user.id">
                            <td style="text-align: center">{{ user.name }}</td>


                        </tr>
                    </table>

                </div>
                <div class="column" style="text-align: center; ">
                    <h1 class="subtitle is-5">Translated JSON files</h1>
                    <table class="table table is-striped"  style="text-align: center">
                        <tr  style="text-align: center"><td><b>Language</b></td><td><b>Code</b></td><td><b>Name</b></td><td><b>Data translated</b></td></tr>


                        <tr v-for="translation in translations" :key="translation.id" style="text-align: center">
                            <td>{{ translation.language.name}}</td>
                            <td>{{ translation.language.code}}</td>
                            <td>{{ translation.filename }}</td>
                            <td>
                                <TranslationTablePreview :data="translation.data"/>
                            </td>
                        </tr>

                    </table>

                </div>

            </div>


        </div>

    </div>

</template>

<script>
    import Newjson from "./Newjson";
    import Translate from "./Translate.vue";
    import TranslationTablePreview from "./TranslationTablePreview";

    export default {
        components: {
            Newjson,
            Translate,
            TranslationTablePreview
        },

        data() {
            return {
                openNewPrForm: false,
                projectName: '',
                projects: [],
                projectId: 'Select dropdown',
                usersOnProject: [],
                translations: [],
                userEmail: ''
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
            },
            async fetchTranslations(){
                try {
                    const {data} = await axios.get(`/api/projects/${this.projectId}/translations`);
                    this.translations = data;
                }catch  {

                }
            },

            async addUserToProject(){
                try {
                    const response = await axios.post(`/api/projects/${this.projectId}/users`, {
                        email: this.userEmail
                    });

                    this.fetchUsers();

                    Swal.fire("Successfully added a new project");
                } catch (e) {
                    Swal.fire(e.response.data.message);
                } finally {
                    this.userEmail= ''
                }

            }

        },
        created() {
            this.fetchProjects();
            this.fetchUsers();

        }
    }
</script>

