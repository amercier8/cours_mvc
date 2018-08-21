class Session{
    constructor (loggedIn) {
        this.loggedIn = loggedIn;

        this.storeInSession();
    }
}