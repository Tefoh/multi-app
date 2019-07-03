<template>
    <div class="">
        <button class="btn btn-success" @click="newModal">اضافه کردن کاربر جدید <i class="fa fa-user-plus"></i></button>

        <!-- Modal -->
        <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserLabel">اضافه کردن کاربر جدید</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addUser">
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
                                    <option value="user">کاربر عادی</option>
                                    <option value="author">نویسنده</option>
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
                                <button :disabled="form.busy" type="submit" class="btn btn-primary">ذخیره</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddUser",

        data() {
            return {
                form: new form({
                    name : '',
                    email : '',
                    password : '',
                    type : '',
                })
            }
        },

        methods: {
            addUser() {
                this.$Progress.start();
                this.form.post('api/user')
                    .then(() => {
                        this.$emit('added');

                        toast.fire({
                            type: 'success',
                            title: 'کاربر با موفقیت ساخته شد'
                        });
                        $('#addUser').modal('hide');

                    })
                    .catch(() => {
                        toast.fire({
                            type: 'danger',
                            title: 'کاربر ساخته نشد'
                        });
                    });
                this.$Progress.finish();


            },

            newModal(user = null) {
                this.form.reset();
                $('#addUser').modal('show');
                if (user) {
                    this.form.fill(user);
                }
            }
        }
    }
</script>

<style scoped>

</style>