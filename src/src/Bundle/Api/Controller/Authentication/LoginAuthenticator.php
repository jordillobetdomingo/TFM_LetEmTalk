<?php


namespace LetEmTalk\Bundle\Api\Controller\Authentication;

use LetEmTalk\Component\Domain\Authentication\Repository\UserCredentialsRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Guard\PasswordAuthenticatedInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginAuthenticator extends AbstractFormLoginAuthenticator implements PasswordAuthenticatedInterface
{
    use TargetPathTrait;

    private const LOGIN_ROUTE = 'api_login';
    private const FIELD_USERNAME = "username";
    private const FIELD_PASSWORD = "password";

    private $userCredentialsRepository;
    private $urlGenerator;
    private $passwordEncoder;

    public function __construct(
        UserCredentialsRepository $userCredentialsRepository,
        UrlGeneratorInterface $urlGenerator,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->userCredentialsRepository = $userCredentialsRepository;
        $this->urlGenerator = $urlGenerator;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function supports(Request $request)
    {
        return self::LOGIN_ROUTE === $request->attributes->get('_route')
            && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        $credentials = json_decode($request->getContent(), true);

        return $credentials;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $userCredentials = $this->userCredentialsRepository->getUserCredentialsByUsername(
            $credentials[self::FIELD_USERNAME]
        );

        if (!$userCredentials) {
            throw new CustomUserMessageAuthenticationException('Username could not be found.');
        }

        return $userCredentials;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return $this->passwordEncoder->isPasswordValid($user, $credentials[self::FIELD_PASSWORD]);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }

        return new Response("", Response::HTTP_NO_CONTENT);
    }

    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }

    public function getPassword($credentials): ?string
    {
        return $credentials[self::FIELD_PASSWORD];
    }
}
