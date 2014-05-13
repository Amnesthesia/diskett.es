# diskett.es

## Abstract
diskett.es is a front-end for the already existing application EpisodeGuide, which helps users stay up to date on their favorite TV shows. All users can browse TV shows and read more about them and the episodes in each season.

A significant difference between the base application EpisodeGuide and diskett.es, is that diskett.es is a *real web application* and not just a web site. By web application, we mean that it's a lot more similar to a native application than sites normally are.

Features are very similar to EpisodeGuide's features, however, everything happens client-side without reloading the page. Something we stated in the first project report, and which we will iterate again, was that what separates our application from others, is its simplicity and ease of use -- it doesn't get more intuitive!

Users are able to ...

* ... sign up in just a few seconds
* ... log in
* ... find (and follow) new (or old) shows
* ... keep the shows they like in a Following list

## Overview

### Introduction
diskett.es uses the popular jQuery based framework **EmberJS** at its base, which is a fully client side javascript Model-Viewer-Whatever framework.

This means that we get some additional initial loading time for the site, but after everything has loaded, each page load happens *instantaneously*. This gives the user a very slick experience similar to a native application -- think about it, what IS an application? An application is usually downloaded code that is then run on a users machine. The code then present the user with a user interface, and allows the user to perform various actions. The difference here being that the code is downloaded and executed in the sandboxed environment of a web browser. This is why it's commonly referred to as a *web application* and not just a web site.

### API & Frameworks

Because Ember is a Model-View-Controller framework, this means that we have a set of **Routes**, **Models**, **Controllers**, **Views**, and **Templates** which make up the site (in addition to *components*, *helpers* and *mixins*).

Like with most MVC frameworks, we have *Routes* that control what context the user is viewing and thus, as the name implies, what *route* the user is currently at. In Ember, Routes are usually visible to the user in the form of URLs, which can be seen as /#/route. Routes are assigned resources, which control what model and controller will be used for the route, and that's where the magic happens.

#### API & Server communication
By default, Ember makes use of its own Store. The Store is actually a separate component (which is not yet fully production ready, but it is operational) called Ember-data. This store allows data to persist in the browsers LocalStorage even on page refresh, which helps us remember things (like user sessions for example) we need, and reduces the amount of required API queries.

The data to fill up the Store is commonly retrieved from an HTTP server providing a RESTful JSON API. Unfortunately for us, Ember seems to have been greatly unfluenced by Ruby on Rails, which provides an API out of the box. PHP, being a language and not a framework, does not provide this. Therefore, to be able to work with Ember's data request, we have taken the effort of writing our own RESTful API to create and update data in the database. Although Ember is highly customizable, the easiest way of doing this is simulating such an API, which is what we have done. By following the URL conventions Ember expects, working with data from our database becomes rather smooth. These URL conventions, using "Show" as an example, are as follows:

| Action   | HTTP State    | URL      | Description                                  |
| :------: | :-----------: | :---:    | -------------                                |
| Find     | GET           | /shows/1 | Fetches an individual show from the database |
| Find All | GET           | /shows   | Fetches **all** shows from the database      |
| Update   | PUT           | /shows/1 | Updates an individual show in the database   |
| Create   | POST          | /shows   | Creates new shows in the database            |
| Delete   | DELETE        | /shows/1 | Deletes a show from the database             |

For retrieving data, the expected output is a JSON object. Because a **Model** can have *relationships* with other models (a Show, for example, hasMany('Episode')), it is expected to return the IDs for its children as well, with the children provided afterwards. An example of this is:

```json
{
"shows":
 [{ "id":104641,
    "imdb_id":"tt1255913",
    "zap2_id":"SH01173055",
    "channel_id":"HBO",
    "poster":"a18f12207b4aa480314ace7f77310f83.jpg",
    "lang":"en",
    "pilot_date":"2009-09-20",
    "name":"Bored to Death",
    "summary":"Jonathan Ames, a young Brooklyn writer, is feeling lost. He's just gone through a painful break-up, thanks in part to his drinking, can't write his second novel, and carouses too much with his magazin",
    "rating":8.3999996185303,"
    lst_update":"2014-02-14",
    "episodes":
        ["104641,1,1",
         "104641,1,2",
         "104641,1,3"
         ]
 }],
 "episodes":
 [
    {
     "id":"104641,1,1",
     "show_id":104641,
     "season":1,
     "episode":1,
     "summary":
     "Broken up after his breakup with his girlfriend Suzanne, Jonathan Ames reads through Farewell My Lovely, his favorite book by Raymond Chandler. Enlivened by the novel, Ames places an online advertisement as an unlicensed private investigator. His fir",
     "date":"2009-09-20"
     },
    {
     "id":"104641,1,2",
     "show_id":104641,
     "season":1,
     "episode":2,
     "summary":"As Jonathan tries to mend his relationship with Suzanne, another case falls onto his lap. This time, he is tasked by a woman named Jennifer to gather proof of her boyfriend Gary's infidelity. Jonathan, who learns his new client loves to drink as much",
     "date":"2009-09-27"
    },
    {
     "id":
     "104641,1,3",
     "show_id":104641,
     "season":1,
     "episode":3,
     "summary":"While attending a New York film society function, George introduces Jonathan to a filmmaker, who asks him to rewrite a screenplay. Later, he goes out with a party girl and leaves the script at her home, which happens to be a shrink's office. Jonathan",
     "date":"2009-10-04"
    }
 ]
}
````
For brevity, we showed only 3 episodes in the output example above, but there may be a lot more. A few things to pay attention to here is the ID. As you can see in the example above, the "id" column actually consists of three comma-separated numbers found again right below it: *show_id*, *episode*, and *season*. This is because each Episode is actually identified in the database by these fields as composite keys, and Episodes **do not have** an ID field. However, Ember being inspired by Rails, **requires** objects to be identified with a field **required** to be named "id", and child-objects cannot be identified by composite keys. The workaround we have implemented for this is to let MySQL solve this when it retrieves the episode rows, with a `CONCAT(`episode`.`show_id`,',',`episode`.`season`,',',`episode`.`episode`)` query. Requests for episodes can then work out the composite keys from this "virtual id" key.

Another thing you may have noticed in this example, is that the *Show* object has a key called *episodes* in plural. This is because Ember expects hasMany relationships to be represented in plural, telling it that "Hey, this object has an array of ids for multiple child objects you can use for the hasMany relationship of the same name!" and after loading the Show object, it will then look for the Episode objects that follow with these key, and make the association.

After a Show has been loaded, all Episodes for that show can be retrieved from `Show.episodes`. Similarly, when updating objects, a PUT request will be made to the server with the appropriate ID, containing an object like this.

Now that we've briefly explained how the client-server communication works, lets take a look at the role of the different system components and where these can be found.

#### Structure & File Structure

A route will by default return the model of the same naming convention as the route -- for example, if the user visits the route *Shows*, the *ShowsController* will be loaded and passed the appropriate model. Because *Shows* is *Show* in plural, and according to naming conventions (which we will mention briefly later on in this document), Ember will assume that this is a collection of *Show*, and as such, it will return an array consisting of all available Show objects.


Configuration files:
* /js/config/app.js
* /js/config/store.js
* /js/config/routes.js

* /js/routes/
* /js/models/
* /js/controllers/
* /js/views/
* /js/templates/

Additionally, Ember makes use of some other JavaScript libraries:

* HandlebarsJS

### API & Frameworks

### Functionality

### User Interface



## Worklog
