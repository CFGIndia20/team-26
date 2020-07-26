// return the user data from the session storage

export const getUser = () => {
    const userStr = localStorage.getItem("user");
    if (userStr) return JSON.parse(userStr);
    else return null;
};

// return the token from the session storage
export const getToken = () => {
    return localStorage.getItem("token") || null;
};

// remove the token and user from the session storage
export const removeUserSession = () => {
    localStorage.removeItem("token");
};

// set the token and user from the session storage
export const setUserSession = (token, user) => {
    localStorage.setItem("token", token);
};

export const validateSession = async () => {
    let token = getToken();
    if (!token) return false;
    else {
        try {
            const res = await fetch("https://jpmc-auth.herokuapp.com/api/verify", {
                headers: { Authorization: `Bearer ${token}` },
            });
            if (res.status === 200) {
                return true;
            } else {
                removeUserSession();
                return false;
            }
        } catch (e) {
            removeUserSession();
            return false;
        }
    }
};
