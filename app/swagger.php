<?php

/**
 * @SWG\Swagger(
 *     schemes={"http","https"},
 *     host="linkedinapi.dev",
 *     basePath="/api/",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Linkedin API System",
 *         description="API for Linkedin system",
 *         termsOfService="",
 *         @SWG\Contact(
 *             email="contact@linkedinapi.dev"
 *         ),
 *         @SWG\License(
 *             name="Private License",
 *             url="URL to the license"
 *         )
 *     ),
 *     @SWG\ExternalDocumentation(
 *         description="Find out more about Linkedin API",
 *         url="linkedinapi.dev"
 *     ),
 *     @SWG\Definition(
 *         definition="Error",
 *         required={"code", "message"},
 *         @SWG\Property(property="code", type="integer", format="int32"),
 *         @SWG\Property(property="message", type="string")
 *     ),
 *     @SWG\Definition(
 *         definition="User",
 *         required={"id", "name", "email", "password", "firstname", "lastname", "avatar", "job", "company"},
 *         @SWG\Property(property="id", type="integer"),
 *         @SWG\Property(property="name", type="string"),
 *         @SWG\Property(property="email", type="string"),
 *         @SWG\Property(property="firstname", type="string"),
 *         @SWG\Property(property="lastname", type="string"),
 *         @SWG\Property(property="avatar", type="string"),
 *         @SWG\Property(property="job", type="string"),
 *         @SWG\Property(property="company", type="string")
 *     ),
 *     @SWG\Definition(
 *         definition="Feed",
 *         required={"id", "content", "image", "video", "user", "likes", "comments", "created_at", "updated_at"},
 *         @SWG\Property(property="id", type="integer"),
 *         @SWG\Property(property="content", type="string"),
 *         @SWG\Property(property="image", type="string"),
 *         @SWG\Property(property="video", type="string"),
 *         @SWG\Property(property="user", type="object"),
 *         @SWG\Property(property="likes", type="integer"),
 *         @SWG\Property(property="comments", type="object"),
 *         @SWG\Property(property="created_at", type="string", format="date-time"),
 *         @SWG\Property(property="updated_at", type="string", format="date-time")
 *     ),
 *     @SWG\Definition(
 *         definition="Comment",
 *         required={"id", "comment_id", "user_id", "post_id", "like_count", "reply_count", "content", "image", "created_at", "updated_at", "user_avatar", "user_name", "user_headline", "is_owner"},
 *         @SWG\Property(property="id", type="integer"),
 *         @SWG\Property(property="comment_id", type="integer"),
 *         @SWG\Property(property="user_id", type="integer"),
 *         @SWG\Property(property="post_id", type="integer"),
 *         @SWG\Property(property="like_count", type="integer"),
 *         @SWG\Property(property="reply_count", type="integer"),
 *         @SWG\Property(property="content", type="string"),
 *         @SWG\Property(property="image", type="string"),
 *         @SWG\Property(property="created_at", type="string", format="date-time"),
 *         @SWG\Property(property="updated_at", type="string", format="date-time"),
 *         @SWG\Property(property="user_avatar", type="string"),
 *         @SWG\Property(property="user_name", type="string"),
 *         @SWG\Property(property="user_headline", type="string"),
 *         @SWG\Property(property="is_owner", type="boolean"),
 *     ),
 *     @SWG\Definition(
 *         definition="Friend",
 *         required={"id", "name", "email", "password", "firstname", "lastname", "avatar", "job", "company"},
 *         @SWG\Property(property="id", type="integer"),
 *         @SWG\Property(property="name", type="string"),
 *         @SWG\Property(property="email", type="string"),
 *         @SWG\Property(property="firstname", type="string"),
 *         @SWG\Property(property="lastname", type="string"),
 *         @SWG\Property(property="avatar", type="string"),
 *         @SWG\Property(property="job", type="string"),
 *         @SWG\Property(property="company", type="string")
 *     ),
 *     @SWG\Definition(
 *         definition="Invitation",
 *         required={"id", "name", "email", "password", "firstname", "lastname", "avatar", "job", "company"},
 *         @SWG\Property(property="id", type="integer"),
 *         @SWG\Property(property="name", type="string"),
 *         @SWG\Property(property="email", type="string"),
 *         @SWG\Property(property="firstname", type="string"),
 *         @SWG\Property(property="lastname", type="string"),
 *         @SWG\Property(property="avatar", type="string"),
 *         @SWG\Property(property="job", type="string"),
 *         @SWG\Property(property="company", type="string")
 *     ),
 *     @SWG\Definition(
 *         definition="Notification",
 *         required={"notification", "user", "post", "comment", "searches", "viewed", "url"},
 *         @SWG\Property(
 *              property="notification",
 *              type="object",
 *              @SWG\Property(property="id", type="integer"),
 *              @SWG\Property(property="type", type="string"),
 *              @SWG\Property(property="is_readed", type="integer"),
 *              @SWG\Property(property="created_at", type="string")
 *         ),
 *         @SWG\Property(
 *              property="user",
 *              type="object",
 *              @SWG\Property(property="id", type="integer"),
 *              @SWG\Property(property="firstname", type="string"),
 *              @SWG\Property(property="lastname", type="string"),
 *              @SWG\Property(property="job", type="string"),
 *              @SWG\Property(property="company", type="string"),
 *              @SWG\Property(property="avatar", type="string")
 *         ),
 *         @SWG\Property(
 *              property="post",
 *              type="object",
 *              @SWG\Property(property="id", type="integer"),
 *              @SWG\Property(property="content", type="string"),
 *              @SWG\Property(property="image", type="string"),
 *              @SWG\Property(property="video", type="string"),
 *              @SWG\Property(property="url", type="string"),
 *              @SWG\Property(property="likes", type="integer"),
 *              @SWG\Property(property="comments", type="integer")
 *         ),
 *         @SWG\Property(
 *              property="comment",
 *              type="object",
 *              @SWG\Property(property="id", type="integer"),
 *              @SWG\Property(property="content", type="string"),
 *              @SWG\Property(property="created_at", type="string"),
 *              @SWG\Property(property="url", type="string")
 *         ),
 *         @SWG\Property(property="searches", type="integer"),
 *         @SWG\Property(property="viewed", type="integer"),
 *         @SWG\Property(property="url", type="string")
 *     ),
 *     @SWG\Definition(
 *         definition="Like",
 *         required={"name", "avatar", "job"},
 *         @SWG\Property(
 *              property="name",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="avatar",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="job",
 *              type="string"
 *         )
 *     ),
 *     @SWG\Definition(
 *         definition="Contact",
 *         required={"id", "name", "email"},
 *         @SWG\Property(
 *              property="id",
 *              type="integer"
 *         ),
 *         @SWG\Property(
 *              property="name",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="email",
 *              type="string"
 *         )
 *     ),
 *     @SWG\Definition(
 *     definition="ExperienceList",
 *     required={"id", "title", "company", "location", "start_month", "start_year",
 *         "end_month", "end_year", "description", "current_work_here", "user_id", "owner"},
 *       @SWG\Property(property="id", type="integer"),
 *       @SWG\Property(property="title", type="string"),
 *       @SWG\Property(property="company", type="string"),
 *       @SWG\Property(property="location", type="string"),
 *       @SWG\Property(property="start_month", type="integer"),
 *       @SWG\Property(property="start_year", type="integer"),
 *       @SWG\Property(property="end_month", type="integer"),
 *       @SWG\Property(property="end_year", type="integer"),
 *       @SWG\Property(property="description", type="string"),
 *       @SWG\Property(property="current_work_here", type="integer"),
 *       @SWG\Property(property="user_id", type="integer"),
 *       @SWG\Property(property="owner", type="boolean")
 *     ),
 *     @SWG\Definition(
 *     definition="MessageList",
 *     required={"conversation", "messages"},
 *       @SWG\Property(
 *         property="conversation",
 *         type="object",
 *         @SWG\Property(property="id", type="integer"),
 *         @SWG\Property(property="name", type="string"),
 *         @SWG\Property(property="user_id", type="integer"),
 *         @SWG\Property(property="is_deleted", type="integer"),
 *         @SWG\Property(property="created_at", type="string"),
 *         @SWG\Property(property="updated_at", type="string")
 *       ),
 *       @SWG\Property(
 *         property="messages",
 *         type="object",
 *         required={"dateTimeKey"},
 *         @SWG\Property(
 *           property="dateTimeKey",
 *           type="object",
 *           @SWG\Property(property="id", type="integer"),
 *           @SWG\Property(property="messageable_type", type="string"),
 *           @SWG\Property(property="user_id", type="integer"),
 *           @SWG\Property(property="content", type="string"),
 *           @SWG\Property(property="created_at", type="string"),
 *           @SWG\Property(property="firstname", type="string"),
 *           @SWG\Property(property="lastname", type="string"),
 *           @SWG\Property(property="user_avatar", type="string"),
 *           @SWG\Property(property="owner", type="boolean"),
 *           @SWG\Property(property="ext_file", type="string")
 *           )
 *       )
 *     ),
 *     @SWG\Definition(
 *     definition="ExperienceItem",
 *     required={"id", "title", "company", "location", "start_month", "start_year",
 *         "end_month", "end_year", "description", "current_work_here", "user_id", "created_at", "updated_at"},
 *       @SWG\Property(property="id", type="integer"),
 *       @SWG\Property(property="title", type="string"),
 *       @SWG\Property(property="company", type="string"),
 *       @SWG\Property(property="location", type="string"),
 *       @SWG\Property(property="start_month", type="integer"),
 *       @SWG\Property(property="start_year", type="integer"),
 *       @SWG\Property(property="end_month", type="integer"),
 *       @SWG\Property(property="end_year", type="integer"),
 *       @SWG\Property(property="description", type="string"),
 *       @SWG\Property(property="current_work_here", type="integer"),
 *       @SWG\Property(property="user_id", type="integer"),
 *       @SWG\Property(property="created_at", type="string"),
 *       @SWG\Property(property="updated_at", type="string"),
 *     ),
 *     @SWG\Definition(
 *         definition="NetworkConnected",
 *         required={"avatar", "company", "connected_ago", "create_at", "email", "firstname",
 *         "headline", "id", "job", "lastname", "name", "updated_at"},
 *         @SWG\Property(
 *              property="avatar",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="company",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="connected_ago",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="create_at",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="email",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="firstname",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="headline",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="id",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="job",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="lastname",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="name",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="updated_at",
 *              type="string"
 *         )
 *     ),
 *     @SWG\Definition(
 *         definition="Skill",
 *         required={"id", "skill", "user_id"},
 *         @SWG\Property(
 *              property="id",
 *              type="integer"
 *         ),
 *         @SWG\Property(
 *              property="skill",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="user_id",
 *              type="integer"
 *         )
 *     ),
 *     @SWG\Definition(
 *         definition="Message",
 *         required={"id", "user_id", "conversation_id", "messageable_type", "content", "created_at", "updated_at"},
 *         @SWG\Property(
 *              property="id",
 *              type="integer"
 *         ),
 *         @SWG\Property(
 *              property="user_id",
 *              type="integer"
 *         ),
 *         @SWG\Property(
 *              property="conversation_id",
 *              type="integer"
 *         ),
 *         @SWG\Property(
 *              property="messageable_type",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="content",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="created_at",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="updated_at",
 *              type="string"
 *         )
 *     ),
 *     @SWG\Definition(
 *         definition="ConversationConvert",
 *         required={"id", "user_id", "conversation_id", "name", "firstname", "lastname", "job", "avatar", "email", "last_message", "number_not_read"},
 *         @SWG\Property(
 *              property="id",
 *              type="integer"
 *         ),
 *         @SWG\Property(
 *              property="user_id",
 *              type="integer"
 *         ),
 *         @SWG\Property(
 *              property="name",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="firstname",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="lastname",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="job",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="avatar",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="email",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="last_message",
 *              type="object"
 *         )
 *     ),
 *     @SWG\Definition(
 *         definition="Education",
 *         required={"school", "degree", "field_study", "grade", "activities", "time_start", "time_end", "description", "user_id", "created_at", "updated_at"},
 *         @SWG\Property(
 *              property="school",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="degree",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="field_study",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="grade",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="activities",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="time_start",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="time_end",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="description",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="user_id",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="created_at",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="updated_at",
 *              type="string"
 *         )
 *     ),
 *     @SWG\Definition(
 *         definition="Job",
 *         required={"title", "image", "company_name", "location", "time_convert", "user_id", "company_id", "country_id", "employment_type", "seniority_level", "email_apply", "description"},
 *         @SWG\Property(
 *              property="title",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="image",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="company_name",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="location",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="time_convert",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="user_id",
 *              type="integer"
 *         ),
 *         @SWG\Property(
 *              property="company_id",
 *              type="integer"
 *         ),
 *         @SWG\Property(
 *              property="country_id",
 *              type="integer"
 *         ),
 *         @SWG\Property(
 *              property="employment_type",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="seniority_level",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="email_apply",
 *              type="string"
 *         ),
 *         @SWG\Property(
 *              property="description",
 *              type="string"
 *         )
 *     )
 * )
 */
