export default async function request(url, {method = 'GET', body = null, headers = {}}) {
    if (body) {
        body = JSON.stringify(body);
        headers['Content-Type'] = 'application/json';
    }

    const res = await fetch(url, { method, body, headers });

    return await res.json();
}