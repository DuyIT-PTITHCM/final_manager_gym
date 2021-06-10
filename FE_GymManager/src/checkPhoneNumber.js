export default {
    checkPhoneNumber: (phone) => {
        var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
        if (vnf_regex.test(phone) == false) {
            return false;
        } else {
            return true;
        }
    }
}