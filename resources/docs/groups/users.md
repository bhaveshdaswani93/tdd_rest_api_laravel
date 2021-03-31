# Users

Users related endpoints

## Change Password Api

<small class="badge badge-darkred">requires authentication</small>

This endpoints allow you to update your password

> Example request:

```bash
curl -X PATCH \
    "http://localhost:8000/api/users/change-password" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"password":"omnis"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/api/users/change-password"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "password": "omnis"
}

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->patch(
    'http://localhost:8000/api/users/change-password',
    [
        'headers' => [
            'Authorization' => 'Bearer {YOUR_AUTH_KEY}',
            'Accept' => 'application/json',
        ],
        'json' => [
            'password' => 'omnis',
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
    "message": "Password updated successfully.",
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
<div id="execution-results-PATCHapi-users-change-password" hidden>
    <blockquote>Received response<span id="execution-response-status-PATCHapi-users-change-password"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-users-change-password"></code></pre>
</div>
<div id="execution-error-PATCHapi-users-change-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-users-change-password"></code></pre>
</div>
<form id="form-PATCHapi-users-change-password" data-method="PATCH" data-path="api/users/change-password" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PATCHapi-users-change-password', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PATCHapi-users-change-password" onclick="tryItOut('PATCHapi-users-change-password');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PATCHapi-users-change-password" onclick="cancelTryOut('PATCHapi-users-change-password');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PATCHapi-users-change-password" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-purple">PATCH</small>
 <b><code>api/users/change-password</code></b>
</p>
<p>
<label id="auth-PATCHapi-users-change-password" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="PATCHapi-users-change-password" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="password" data-endpoint="PATCHapi-users-change-password" data-component="body" required  hidden>
<br>
</p>

</form>


## Update User Api

<small class="badge badge-darkred">requires authentication</small>

This Endpoint allow user to update their profile

> Example request:

```bash
curl -X PATCH \
    "http://localhost:8000/api/users/profile" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"dolor","email":"houston.powlowski@example.net"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/api/users/profile"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "dolor",
    "email": "houston.powlowski@example.net"
}

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->patch(
    'http://localhost:8000/api/users/profile',
    [
        'headers' => [
            'Authorization' => 'Bearer {YOUR_AUTH_KEY}',
            'Accept' => 'application/json',
        ],
        'json' => [
            'name' => 'dolor',
            'email' => 'houston.powlowski@example.net',
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
    "message": "User profile updated successfully.",
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
<div id="execution-results-PATCHapi-users-profile" hidden>
    <blockquote>Received response<span id="execution-response-status-PATCHapi-users-profile"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-users-profile"></code></pre>
</div>
<div id="execution-error-PATCHapi-users-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-users-profile"></code></pre>
</div>
<form id="form-PATCHapi-users-profile" data-method="PATCH" data-path="api/users/profile" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PATCHapi-users-profile', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PATCHapi-users-profile" onclick="tryItOut('PATCHapi-users-profile');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PATCHapi-users-profile" onclick="cancelTryOut('PATCHapi-users-profile');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PATCHapi-users-profile" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-purple">PATCH</small>
 <b><code>api/users/profile</code></b>
</p>
<p>
<label id="auth-PATCHapi-users-profile" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="PATCHapi-users-profile" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="name" data-endpoint="PATCHapi-users-profile" data-component="body" required  hidden>
<br>
The Name of the post.</p>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="email" data-endpoint="PATCHapi-users-profile" data-component="body" required  hidden>
<br>
The unique email of the user.</p>

</form>



