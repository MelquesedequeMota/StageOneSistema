<?php
namespace App\Http\Middleware;
use App\Http\Models\Pessoas;
use App\Support\TenantConnector;
use Closure;
class Tenant {
    use TenantConnector;
    /**
     * @var pessoas
     */
    protected $pessoas;
    /**
     * Tenant constructor.
     * @param pessoas $pessoas
     */
    public function __construct(pessoas $pessoas) {
        $this->pessoas = $pessoas;
    }
    /**
     * Trata a requisição
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (($request->session()->get('cpfcnpjpessoa')) === null)
            return redirect()->route('login');
        // Busca a pessoas pelo id armazenado na sessão
        $pessoas = $this->pessoas->find($request->session()->get('cpfcnpjpessoa'));
        // Conecta no banco escolhido e colocar a variavel $pessoas na sessão
        $this->reconnect($pessoas);
        $request->session()->put('pessoas', $pessoas);
        return $next($request);
    }
}