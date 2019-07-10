export default class Gate {

    constructor(user) {
        this.user = user;
    }

    isAdmin() {
        return this.user.type === 'admin';
    }

    isFreelancer() {
        return this.user.type === 'freelancer';
    }

    isUser() {
        return this.user.type === 'user';
    }

    isAdminOrFreelancer() {
        if (this.user.type === 'admin' || this.user.type === 'freelancer')  {
            return true;
        }
    }

    isAdminOrUser() {
        if (this.user.type === 'admin' || this.user.type === 'user')  {
            return true;
        }
    }


}