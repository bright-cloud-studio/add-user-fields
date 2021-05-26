# Bright Cloud Studio's Add User Fields
Adds two custom fields to users, an image and a bio, which can be shown on News posts using custom template tags.

- On the User's settings page will be a new section where you can attach an image and a bio

![Example Image 1](https://raw.githubusercontent.com/bright-cloud-studio/add-user-fields/main/images/ss_1.jpg)



- On the "news_full.html5" template, or any template that has an author, add the image tags "{{user_image::id}}" and "{{user_bio::id}}" with the author's id and it will display.
* For this example $author_id is obtained using \NewsModel::findByAlias

![Example Image 2](https://raw.githubusercontent.com/bright-cloud-studio/add-user-fields/main/images/ss_2.jpg)


- Can be styled using the "user_image" and "user_bio" class and id.
