# Posts

Posts related endpoints

## api/posts

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost:8000/api/posts" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title":"at","description":"aut"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/api/posts"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "at",
    "description": "aut"
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
    'http://localhost:8000/api/posts',
    [
        'headers' => [
            'Authorization' => 'Bearer {YOUR_AUTH_KEY}',
            'Accept' => 'application/json',
        ],
        'json' => [
            'title' => 'at',
            'description' => 'aut',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


<div id="execution-results-POSTapi-posts" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-posts"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-posts"></code></pre>
</div>
<div id="execution-error-POSTapi-posts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-posts"></code></pre>
</div>
<form id="form-POSTapi-posts" data-method="POST" data-path="api/posts" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-posts', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-posts" onclick="tryItOut('POSTapi-posts');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-posts" onclick="cancelTryOut('POSTapi-posts');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-posts" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/posts</code></b>
</p>
<p>
<label id="auth-POSTapi-posts" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-posts" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>title</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="title" data-endpoint="POSTapi-posts" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>description</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="description" data-endpoint="POSTapi-posts" data-component="body" required  hidden>
<br>
</p>

</form>


## api/posts/{post}

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X PATCH \
    "http://localhost:8000/api/posts/temporibus" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title":"exercitationem","description":"et"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/api/posts/temporibus"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "exercitationem",
    "description": "et"
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
    'http://localhost:8000/api/posts/temporibus',
    [
        'headers' => [
            'Authorization' => 'Bearer {YOUR_AUTH_KEY}',
            'Accept' => 'application/json',
        ],
        'json' => [
            'title' => 'exercitationem',
            'description' => 'et',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```


<div id="execution-results-PATCHapi-posts--post-" hidden>
    <blockquote>Received response<span id="execution-response-status-PATCHapi-posts--post-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-posts--post-"></code></pre>
</div>
<div id="execution-error-PATCHapi-posts--post-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-posts--post-"></code></pre>
</div>
<form id="form-PATCHapi-posts--post-" data-method="PATCH" data-path="api/posts/{post}" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PATCHapi-posts--post-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PATCHapi-posts--post-" onclick="tryItOut('PATCHapi-posts--post-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PATCHapi-posts--post-" onclick="cancelTryOut('PATCHapi-posts--post-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PATCHapi-posts--post-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-purple">PATCH</small>
 <b><code>api/posts/{post}</code></b>
</p>
<p>
<label id="auth-PATCHapi-posts--post-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="PATCHapi-posts--post-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>post</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="post" data-endpoint="PATCHapi-posts--post-" data-component="url" required  hidden>
<br>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>title</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="title" data-endpoint="PATCHapi-posts--post-" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>description</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="description" data-endpoint="PATCHapi-posts--post-" data-component="body" required  hidden>
<br>
</p>

</form>


## api/posts/{post}

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/api/posts/ipsa" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/posts/ipsa"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://localhost:8000/api/posts/ipsa',
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


> Example response (401):

```json
{
    "result": false,
    "message": "Given authorization token is invalid, please login again",
    "payload": null,
    "errors": null
}
```
<div id="execution-results-GETapi-posts--post-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-posts--post-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-posts--post-"></code></pre>
</div>
<div id="execution-error-GETapi-posts--post-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-posts--post-"></code></pre>
</div>
<form id="form-GETapi-posts--post-" data-method="GET" data-path="api/posts/{post}" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-posts--post-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-posts--post-" onclick="tryItOut('GETapi-posts--post-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-posts--post-" onclick="cancelTryOut('GETapi-posts--post-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-posts--post-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/posts/{post}</code></b>
</p>
<p>
<label id="auth-GETapi-posts--post-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-posts--post-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>post</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="post" data-endpoint="GETapi-posts--post-" data-component="url" required  hidden>
<br>
</p>
</form>


## api/posts/{post}

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X DELETE \
    "http://localhost:8000/api/posts/quod" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/posts/quod"
);

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete(
    'http://localhost:8000/api/posts/quod',
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


<div id="execution-results-DELETEapi-posts--post-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEapi-posts--post-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-posts--post-"></code></pre>
</div>
<div id="execution-error-DELETEapi-posts--post-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-posts--post-"></code></pre>
</div>
<form id="form-DELETEapi-posts--post-" data-method="DELETE" data-path="api/posts/{post}" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEapi-posts--post-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEapi-posts--post-" onclick="tryItOut('DELETEapi-posts--post-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEapi-posts--post-" onclick="cancelTryOut('DELETEapi-posts--post-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEapi-posts--post-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>api/posts/{post}</code></b>
</p>
<p>
<label id="auth-DELETEapi-posts--post-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="DELETEapi-posts--post-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>post</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="post" data-endpoint="DELETEapi-posts--post-" data-component="url" required  hidden>
<br>
</p>
</form>


## List Post Api

<small class="badge badge-darkred">requires authentication</small>

This endpoint will list posts of logged in user in pagination manner

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/api/posts?page=18" \
    -H "Authorization: Bearer {YOUR_AUTH_KEY}" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/posts"
);

let params = {
    "page": "18",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://localhost:8000/api/posts',
    [
        'headers' => [
            'Authorization' => 'Bearer {YOUR_AUTH_KEY}',
            'Accept' => 'application/json',
        ],
        'query' => [
            'page'=> '18',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
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
> Example response (200):

```json
{
    "result": true,
    "message": "",
    "payload": {
        "data": [
            {
                "user_id": 81,
                "title": "Est dolor doloremque iure.",
                "description": "Omnis ipsa est minus illo omnis alias. Doloribus officiis doloribus excepturi dolores. Est quia officia rerum hic repellat fugiat.",
                "post_id": 90
            },
            {
                "user_id": 81,
                "title": "Quis assumenda ea cupiditate ipsam cupiditate quia.",
                "description": "Ex dolorem corrupti voluptatum minima autem voluptatem quas et. Sequi reiciendis odio consequatur voluptatem sapiente.",
                "post_id": 91
            },
            {
                "user_id": 81,
                "title": "Vel similique non libero dolorum dolorem impedit.",
                "description": "Tenetur quae aut est vitae. Repellendus at et maxime in in voluptas expedita. Et nisi repellendus voluptatum sint nobis.",
                "post_id": 92
            },
            {
                "user_id": 81,
                "title": "Consequatur optio nam et dignissimos incidunt.",
                "description": "Placeat culpa omnis repellat nam voluptas voluptas. Dolorem magnam assumenda et.",
                "post_id": 93
            },
            {
                "user_id": 81,
                "title": "Eaque quisquam quasi sit dolorem dolorem.",
                "description": "Velit ad illo explicabo eum tempore sunt ipsum. Praesentium iste cumque animi. Labore minus ea possimus ut et voluptatum.",
                "post_id": 94
            },
            {
                "user_id": 81,
                "title": "Enim qui odit possimus occaecati ad qui enim.",
                "description": "Eligendi tempora et aut nobis enim consequuntur. Cum aut voluptatem odio recusandae deserunt. A delectus consequuntur explicabo tempore.",
                "post_id": 95
            },
            {
                "user_id": 81,
                "title": "Autem libero ducimus nobis ut velit beatae doloremque.",
                "description": "Ipsa delectus doloribus iste similique consequuntur perferendis est consectetur. Fugit consequatur quaerat ut quo ut vel accusamus. Voluptas eveniet omnis est distinctio officiis. Tenetur nostrum enim facere quis cum ad.",
                "post_id": 96
            },
            {
                "user_id": 81,
                "title": "Nam laboriosam qui quo odio nostrum rerum culpa.",
                "description": "Sapiente quis et magni quis sit. Facilis neque sequi quia qui rerum.",
                "post_id": 97
            },
            {
                "user_id": 81,
                "title": "Nihil itaque incidunt voluptatem debitis.",
                "description": "Natus non magni enim culpa quae sed nam animi. Laborum qui mollitia distinctio maxime ut molestiae reprehenderit. Voluptatum dignissimos et facere est aut maxime sunt.",
                "post_id": 98
            },
            {
                "user_id": 81,
                "title": "Unde et nisi autem.",
                "description": "Sunt sed ea cum et non ex nihil. Eaque dolores provident eos consequatur repellat expedita. Ut veniam voluptatum et numquam repellat. Nesciunt ratione tempore a.",
                "post_id": 99
            }
        ],
        "links": {
            "first": "http:\/\/localhost:8000\/api\/posts?page=1",
            "last": "http:\/\/localhost:8000\/api\/posts?page=3",
            "prev": null,
            "next": "http:\/\/localhost:8000\/api\/posts?page=2"
        },
        "meta": {
            "current_page": 1,
            "from": 1,
            "last_page": 3,
            "links": [
                {
                    "url": null,
                    "label": "&laquo; Previous",
                    "active": false
                },
                {
                    "url": "http:\/\/localhost:8000\/api\/posts?page=1",
                    "label": "1",
                    "active": true
                },
                {
                    "url": "http:\/\/localhost:8000\/api\/posts?page=2",
                    "label": "2",
                    "active": false
                },
                {
                    "url": "http:\/\/localhost:8000\/api\/posts?page=3",
                    "label": "3",
                    "active": false
                },
                {
                    "url": "http:\/\/localhost:8000\/api\/posts?page=2",
                    "label": "Next &raquo;",
                    "active": false
                }
            ],
            "path": "http:\/\/localhost:8000\/api\/posts",
            "per_page": "10",
            "to": 10,
            "total": 26
        }
    },
    "errors": null
}
```
<div id="execution-results-GETapi-posts" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-posts"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-posts"></code></pre>
</div>
<div id="execution-error-GETapi-posts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-posts"></code></pre>
</div>
<form id="form-GETapi-posts" data-method="GET" data-path="api/posts" data-authed="1" data-hasfiles="0" data-headers='{"Authorization":"Bearer {YOUR_AUTH_KEY}","Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-posts', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-posts" onclick="tryItOut('GETapi-posts');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-posts" onclick="cancelTryOut('GETapi-posts');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-posts" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/posts</code></b>
</p>
<p>
<label id="auth-GETapi-posts" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-posts" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="page" data-endpoint="GETapi-posts" data-component="query"  hidden>
<br>
Use for seeing next page record in pagination. Defaults to 1.</p>
</form>

### Response
<h4 class="fancy-heading-panel"><b>Response Fields</b></h4>
<p>
<b><code>current_page</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
The current page in the pagination</p>
<p>
<b><code>from</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
The start page in the pagination</p>
<p>
<b><code>last_page</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
The last page in the pagination</p>
<p>
<b><code>per_page</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<br>
Number of records per page</p>


