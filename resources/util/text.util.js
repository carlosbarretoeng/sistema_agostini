export default {
    initials(text) {
        const textSplitted = text.split(" ");
        return textSplitted[0][0].toUpperCase() + textSplitted[textSplitted.length - 1][0].toUpperCase();
    }
};