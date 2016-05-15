<?php

namespace CodeDelivery\Http\Middleware;

use Closure;
use CodeDelivery\Repositories\UserRepository;
use LucaDegasperi\OAuth2Server\Authorizer;

class OAuthCheckRole
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var Authorizer
     */
    private $authorizer;

    /**
     * OAuthCheckRole constructor.
     * @param UserRepository $userRepository
     * @param Authorizer $authorizer
     */
    public function __construct(UserRepository $userRepository, Authorizer $authorizer)
    {
        $this->userRepository = $userRepository;
        $this->authorizer = $authorizer;
    }

    /**
     * Handle an incoming request.
     *
     * @param  IlluminateHttpRequest  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role) //aqui adicionamos um parametro para o middleware
    {
        $id = $this->authorizer->getResourceOwnerId();
        $user = $this->userRepository->find($id);

        if ($user->role != $role){
            abort(403, 'Access forbidden');
        }

        return $next($request);
    }

}
