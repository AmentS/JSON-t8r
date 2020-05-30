<template>
    <div class="container">

        <div class="container" style="text-align: center; margin-bottom: 10px">
            <p class="title">System Overview</p>
            <GChart
                type="PieChart"
                :data="userChartData"
            />
        </div>

        <div class="columns">
            <div class="column is-one-third" style="text-align: center;">
                <h1 class="subtitle is-5">All users</h1>
                <table class="table table is-striped" style="text-align: center">
                    <tr v-for="user in users" :key="user.id">
                        <td style="text-align: center">{{ user.name }}</td>
                        <td style="text-align: center">
                            <button class="button is-info" @click="selectedUser = user">
                                About
                            </button>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="column">
                <table class="table table is-striped" style="text-align: center">
                    <tr style="text-align: center">
                        <td><b>Problem</b></td>
                        <td><b>Description</b></td>
                        <td><b>User</b></td>
                        <td><b></b></td>
                    </tr>
                    <tr v-for="contact in contacts" :key="contact.id" style="text-align: center">
                        <td>{{contact.problem}}</td>
                        <td>{{contact.description}}</td>
                        <td>{{contact.user.name}}</td>
                        <td>
                            <button class="button is-info" @click="selectedContact = contact">
                                Open
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="modal" v-bind:class="{'is-active': selectedUser}" v-if="selectedUser">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title"></p>
                    <button class="delete" aria-label="close" @click="selectedUser = null"></button>
                </header>
                <section class="modal-card-body">
                    <p>Full name: {{ selectedUser.name }}</p>
                    <p>E-mail: {{ selectedUser.email }}</p>
                    <div v-if="selectedUser.projects.length" class="content">
                        <p>Project this user is a part of:</p>
                        <ul>
                            <li v-for="project in selectedUser.projects" :key="project.id">
                                {{ project.name }}
                            </li>
                        </ul>
                    </div>
                    <p v-else>This user has no projects</p>
                </section>
            </div>
        </div>

        <div class="modal" v-bind:class="{'is-active': selectedContact}" v-if="selectedContact">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">{{selectedContact.problem}}</p>
                    <button class="delete" aria-label="close" @click="selectedContact = null"></button>
                </header>
                <section class="modal-card-body">
                    {{selectedContact.description}}
                </section>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                contacts: [],
                users: [],
                selectedUser: null,
                selectedContact: null,
            }
        },
        methods: {
            async fetchUsers() {
                try {
                    const {data} = await axios.get(`/api/users`);
                    this.users = data;
                } catch {

                }
            },
            async fetchContacts() {
                try {
                    const {data} = await axios.get(`/api/contact`);
                    this.contacts = data;
                } catch {

                }
            },
        },
        created() {
            this.fetchUsers();
            this.fetchContacts();
        },
        computed: {
            chartData() {
                return [
                    ['Task', 'Hours per Day'],
                    ['Work',],
                    ['Eat', 2],
                    ['Commute', 2],
                    ['Watch TV', 2],
                    ['Sleep', 7]
                ]
            },
            userChartData() {
                // ... => [['User', 'Projects'], [], [], []]
                // [['User', 'Projects'], [ [], [], [] ]]
                return [
                    ['User', 'Projects'],
                    ...this.users.map(u => ([u.name, u.projects.length]))
                ]
            }
        }
    }
</script>

