# Authentication Endpoints

APIs for Register,Login,Logout users

## Register Api


This endpoint allow you to register user.

> Example request:

```bash
curl -X POST \
    "http://localhost:8000/api/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"accusantium","email":"houston.powlowski@example.net","password":"voluptate"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/api/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "accusantium",
    "email": "houston.powlowski@example.net",
    "password": "voluptate"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://localhost:8000/api/register',
    [
        'headers' => [
            'Accept' => 'application/json',
        ],
        'json' => [
            'name' => 'accusantium',
            'email' => 'houston.powlowski@example.net',
            'password' => 'voluptate',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "result": true,
    "message": "",
    "payload": {
        "user_id": 2,
        "name": "Lorem",
        "email": "ipsum+1@gmail.com",
        "auth_token": "<auth token>"
    },
    "errors": null
}
```
> Example response (422, Email already registered):

```json
{
    "result": false,
    "message": "Validation Error",
    "payload": null,
    "errors": {
        "email": [
            "The email has already been taken."
        ]
    }
}
```
<div id="execution-results-POSTapi-register" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-register"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-register"></code></pre>
</div>
<div id="execution-error-POSTapi-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-register"></code></pre>
</div>
<form id="form-POSTapi-register" data-method="POST" data-path="api/register" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-register', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-register" onclick="tryItOut('POSTapi-register');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-register" onclick="cancelTryOut('POSTapi-register');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-register" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/register</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="name" data-endpoint="POSTapi-register" data-component="body" required  hidden>
<br>
The Name of the post.</p>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-register" data-component="body" required  hidden>
<br>
The unique email of the user.</p>
<p>
<b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="password" data-endpoint="POSTapi-register" data-component="body" required  hidden>
<br>
The password which will be used for login</p>

</form>

### Response
<h4 class="fancy-heading-panel"><b>Response Fields</b></h4>
<p>
<b><code>auth_token</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<br>
The Bearer token which should be included in header for auth required endpoint</p>

## Login Api


This endpoint allow you to login user.

> Example request:

```bash
curl -X POST \
    "http://localhost:8000/api/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"houston.powlowski@example.net","password":"voluptates"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/api/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "houston.powlowski@example.net",
    "password": "voluptates"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://localhost:8000/api/login',
    [
        'headers' => [
            'Accept' => 'application/json',
        ],
        'json' => [
            'email' => 'houston.powlowski@example.net',
            'password' => 'voluptates',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "result": true,
    "message": "",
    "payload": {
        "user_id": 6,
        "name": "Lorem",
        "email": "ipsum+3@gmail.com",
        "auth_token": "<auth token>"
    },
    "errors": null
}
```
> Example response (400, Wrong password):

```json
{
    "result": false,
    "message": "Wrong password provided.",
    "payload": null,
    "errors": null
}
```
<div id="execution-results-POSTapi-login" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-login"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-login"></code></pre>
</div>
<div id="execution-error-POSTapi-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-login"></code></pre>
</div>
<form id="form-POSTapi-login" data-method="POST" data-path="api/login" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-login', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-login" onclick="tryItOut('POSTapi-login');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-login" onclick="cancelTryOut('POSTapi-login');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-login" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/login</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-login" data-component="body" required  hidden>
<br>
The unique email of the user.</p>
<p>
<b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="password" data-endpoint="POSTapi-login" data-component="body" required  hidden>
<br>
The password which will be used for login</p>

</form>

### Response
<h4 class="fancy-heading-panel"><b>Response Fields</b></h4>
<p>
<b><code>auth_token</code></b>&nbsp;&nbsp;  &nbsp;
<br>
The Bearer token which should be included in header for auth required endpoint</p>

## Logout the user

<small class="badge badge-darkred">requires authentication</small>

This endpoints allow user to logout

> Example request:

```bash
curl -X POST \
    "http://localhost:8000/api/logout" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/logout"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://localhost:8000/api/logout',
    [
        'headers' => [
            'Authorization' => 'Bearer {YOUR_AUTH_KEY}',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


> Example response (200):

```json
{
    "result": true,
    "message": "User logout successfully.",
    "payload": null,
    "errors": null
}
```
> Example response (401, Unauthenticated):

```json
{
    "result": false,
    "message": "Given authorization token is invalid, please login again",
    "payload": null,
    "errors": null
}
```
<div id="execution-results-POSTapi-logout" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-logout"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-logout"></code></pre>
</div>
<div id="execution-error-POSTapi-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-logout"></code></pre>
</div>
<form id="form-POSTapi-logout" data-method="POST" data-path="api/logout" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-logout', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-logout" onclick="tryItOut('POSTapi-logout');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-logout" onclick="cancelTryOut('POSTapi-logout');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-logout" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/logout</code></b>
</p>
<p>
<label id="auth-POSTapi-logout" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-logout" data-component="header"></label>
</p>
</form>



