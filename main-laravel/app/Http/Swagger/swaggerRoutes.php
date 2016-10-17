<?php 
// ******************************* USER ******************************* //


//-----------------------------------------------------
// Register a User
//-----------------------------------------------------

/**
 * @SWG\Post(path="/register",
 *   tags={"user"},
 *   summary="Register user",
 *   description="Register user to the system.",
 *   operationId="registerUser",
 *   produces={"application/json"},
 *   @SWG\Parameter(
 *     in="body",
 *     name="body",
 *     description="Created user object",
 *     required=true,
 *     @SWG\Schema(ref="#/definitions/User")
 *   ),
 *   @SWG\Response(response="default", description="successful operation")
 * )
 */

//-----------------------------------------------------
// Confirm Registered User
//-----------------------------------------------------

/**
 * @SWG\Get(path="/register/verify/{confirmation_code}",
 *   tags={"user"},
 *   summary="Confirm registered user",
 *   description="Confirm registered user in the system.",
 *   operationId="confirmUser",
 *   produces={"application/json"},
 *   @SWG\Parameter(
 *         description="Confirmation code from email sent.",
 *         in="path",
 *         name="confirmation_code",
 *         required=true,
 *         type="string"
 *     ),
 *   @SWG\Response(response="default", description="successful operation")
 * )
 */

//-----------------------------------------------------
// User Login
//-----------------------------------------------------

/**
 * @SWG\Post(path="/login",
 *   tags={"user"},
 *   summary="Login user",
 *   description="Login user to the system.",
 *   operationId="loginUser",
 *   produces={"application/json"},
 *   @SWG\Parameter(
 *     in="body",
 *     name="body",
 *     description="Created user object",
 *     required=true,
 *     @SWG\Schema(ref="#/definitions/UserLogin")
 *   ),
 *   @SWG\Response(response="default", description="successful operation")
 * )
 */

// ******************************* USER ******************************* //


//-----------------------------------------------------
// Create a Float
//-----------------------------------------------------

/**
 * @SWG\Post(path="/float/create",
 *   tags={"float"},
 *   summary="Creat float",
 *   description="Create a new float.",
 *   operationId="createFloat",
 *   produces={"application/json"},
 *   @SWG\Parameter(
 *     in="body",
 *     name="body",
 *     description="Created float object",
 *     required=true,
 *     @SWG\Schema(ref="#/definitions/Float")
 *   ),
 *   @SWG\Response(response="default", description="successful operation")
 * )
 */

//--