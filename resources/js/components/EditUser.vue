<template>
    <div class="">
        <a href="#">
            <i class="fa fa-edit blue"></i>
        </a>
    </div>
</template>

<script>
    export default {
        name: "EditUser",

        props: ['user'],

        data() {
            return {
            }
        },

        created() {
            this.form.reset();
            this.form.fill(this.user);
            this.$on('edit', (id) => {
                console.log(id);
            });
        },

        methods: {
            editUser(user) {
                this.$Progress.start();
                this.form.patch('api/user/' + this.user.id)
                    .then(() => {
                        this.$emit('edited');

                        toast.fire({
                            type: 'success',
                            title: 'کاربر با موفقیت ساخته شد'
                        });
                        $('#editUser').modal('hide');

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
                $('#editUser').modal('show');
                if (user) {
                    this.form.fill(user);
                }
            }
        }
    }
</script>

<style scoped>

</style>