// String helpers
function slug(str) {
    return str.toLowerCase()
        .replace(/[^\w\s-]/g, '')
        .replace(/[\s_-]+/g, '-')
        .replace(/^-+|-+$/g, '');
}

function stripLines(str) {
    return str.replace(/\s+/g, "").trim()
}

export default {slug, stripLines}