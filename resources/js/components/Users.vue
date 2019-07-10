<template>
    <div class="container">
        <div class="row mt-5">

            <div v-if="! $gate.isAdmin()">
                <not-found></not-found>
            </div>

            <div class="col-12" v-if="$gate.isAdmin()">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">لیست کاربران</h3>

                        <div class="card-tools">
                            <add-user @added="loadUsers"></add-user>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>شماره</th>
                                    <th>نام</th>
                                    <th>ایمیل</th>
                                    <th>نقش</th>
                                    <th>ساخت حساب</th>
                                    <th></th>
                                </tr>
                                <tr v-for="user in users.data" >
                                    <td>{{ user.id }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.created_at | strDate }}</td>
                                    <td>{{ user.type }}</td>
                                    <td>
                                        <a href="#" @click="editModal(user)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        \
                                        <a href="#" class="p-1 alert-danger" @click="deleteUser(user.id)">
                                            <i class="fa fa-trash "></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="users" @pagination-change-page="loadUsers"></pagination>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUserLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserLabel">ویرایش کاربر {{ this.form.name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="editUser">
                            <div class="form-group">
                                <label>نام</label>
                                <input v-model="form.name" type="text" name="name"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label>ایمیل</label>
                                <input v-model="form.email" type="text" name="email"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>

                            <div class="form-group">
                                <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                                    <option value="">نقش را انتخاب کنید</option>
                                    <option value="admin">مدیر</option>
                                    <option value="user">کارفرما</option>
                                    <option value="freelancer">فریلنسر</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>

                            <div class="form-group">
                                <label>رمز عبور</label>
                                <input v-model="form.password" type="password" name="password"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                <button :disabled="form.busy" type="submit" class="btn info">اپدیت</button>
                            </div>
                            <input type="hidden" :v-model="form.id">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import AddUser from './AddUser'

    export default {
        name: "Users",

        components: {
            AddUser
        },

        data() {
            return {
                editingMode: false,
                editingUser: [],
                users: {},
                form: new form({
                    id : '',
                    name : '',
                    email : '',
                    password : '',
                    type : '',
                })
            }
        },

        methods: {
            loadUsers(page = 1) {
                if (this.$gate.isAdmin()) {
                    axios.get('api/user?page=' + page).then(({ data }) => (this.users = data));
                }
            },

            deleteUser(id) {
                swal.fire({
                    title: 'مطمئن هستید؟',
                    text: "قادر به بازیابی نیستید!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'بله!'
                }).then((result) => {

                    if (result.value) {
                        axios.delete('api/user/' + id)
                            .then(() => {

                                this.loadUsers();
                                    swal.fire(
                                        'حذف شد!',
                                        'کاربر مورد نظر حذف شد.',
                                        'success'
                                    )
                            }).catch(() => {
                                swal.fire(
                                    'مشکلی پیش امد!',
                                    'کاربر مورد نظر حذف نشد.',
                                    'warning'
                                )
                            });
                    }
                })
            },
            editUser() {
                this.$Progress.start();
                this.form.patch('api/user/' + this.form.id)
                    .then(() => {
                        this.loadUsers();
                        toast.fire({
                            type: 'success',
                            title: 'کاربر با موفقیت ویرایش شد'
                        });
                        $('#editUser').modal('hide');

                    })
                    .catch(() => {
                        toast.fire({
                            type: 'danger',
                            title: 'کاربر ویرایش نشد'
                        });
                    });
                this.$Progress.finish();


            },

            editModal(user) {
                this.editingMode = true;
                this.editingUser = user;

                this.form.fill(user);
                $('#editUser').modal('show');

            }
        },

        created() {
            this.loadUsers();
            this.$on('added', () => {
                this.loadUsers();
            });
            this.$root.$on('searching', () => {
                axios.get('api/search/user?name=' + this.$parent.search)
                    .then(({ data }) => (this.users = data));
            });
        }
    }
</script>

<style scoped>

</style>