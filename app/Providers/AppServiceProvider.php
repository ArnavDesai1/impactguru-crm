public static function redirectTo()
{
    if (auth()->check() && auth()->user()->role === 'admin') {
        return '/admin/dashboard';
    }

    return '/dashboard';
}
