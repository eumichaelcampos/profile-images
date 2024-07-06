### Profile Images Plugin Documentação

---

# Profile Images

Exibe thumbnails dos perfis dos usuários cadastrados no site com opções de ordem aleatória e limite de quantidade.

## Índice

1. [Descrição](#descrição)
2. [Instalação](#instalação)
3. [Uso](#uso)
4. [Opções do Shortcode](#opções-do-shortcode)
5. [Configurações](#configurações)
6. [Customização](#customização)
7. [Internacionalização](#internacionalização)
8. [Contribuição](#contribuição)
9. [Licença](#licença)

---

## Descrição

O plugin Profile Images permite exibir thumbnails dos perfis dos usuários cadastrados no seu site WordPress. Você pode configurar várias opções, como cor da borda, tamanho da borda, tamanho das thumbnails e exibição em ordem aleatória. O plugin usa um shortcode para incorporar as thumbnails dos perfis dos usuários em qualquer lugar do seu site.

## Instalação

1. Faça o upload dos arquivos do plugin para o diretório `/wp-content/plugins/profile-images` ou instale o plugin diretamente pela tela de plugins do WordPress.
2. Ative o plugin através da tela 'Plugins' no WordPress.
3. Configure o plugin através da página de configurações em 'Configurações > Profile Images'.

## Uso

Para exibir as thumbnails dos perfis dos usuários, use o shortcode `[profile_images]` em qualquer página ou post. As thumbnails serão exibidas de acordo com as configurações configuradas no painel de administração.

### Exemplo de Shortcode

```plaintext
[profile_images]
```

## Opções do Shortcode

O shortcode `[profile_images]` suporta as seguintes opções:

- `quantity`: Número de thumbnails de perfis de usuários a serem exibidos. O padrão é `5`.
- `random`: Exibe thumbnails em ordem aleatória. Aceita `true` ou `false`. O padrão é `false`.

### Exemplo de Shortcode com Opções

```plaintext
[profile_images quantity="10" random="true"]
```

## Configurações

As configurações do plugin podem ser encontradas na página 'Configurações > Profile Images' no painel de administração do WordPress. As seguintes opções estão disponíveis:

- **Cor da Borda**: Define a cor da borda das thumbnails dos perfis.
- **Tamanho da Borda**: Define a largura da borda das thumbnails dos perfis.
- **Modo Aleatório**: Ativa ou desativa a exibição aleatória das thumbnails dos perfis.
- **Tamanho das Thumbnails**: Define o tamanho das thumbnails dos perfis.

## Customização

### Estilos Personalizados

Você pode adicionar estilos personalizados ao seu tema para modificar a aparência das thumbnails dos perfis. O plugin adiciona as seguintes classes CSS que podem ser usadas para estilização:

- `.profile-images-thumbnails`: Container para todas as thumbnails dos perfis.
- `.profile-thumbnail`: Container para cada thumbnail de perfil individual.
- `.profile-thumbnail img`: A própria imagem da thumbnail.

### Exemplo de CSS Personalizado

```css
.profile-thumbnail img {
    border-radius: 50%;
    border: 2px solid #ff0000;
}
```

## Internacionalização

Este plugin está pronto para tradução. Para adicionar uma nova tradução, siga estas etapas:

1. Crie um arquivo `.po` para o seu idioma na pasta `languages` do plugin.
2. Use um software como o Poedit para adicionar as traduções.
3. Salve o arquivo como `profile-images-LOCALE.po` e compile-o como `profile-images-LOCALE.mo`.

Se você quiser contribuir com traduções, por favor, envie seus arquivos de tradução para example@example.com.

## Contribuição

Contribuições são bem-vindas! Se você tiver sugestões, encontrar bugs ou quiser contribuir com código, por favor, siga estas etapas:

1. Faça um fork do repositório.
2. Crie um branch para a sua feature ou correção de bug (`git checkout -b minha-nova-feature`).
3. Commit suas mudanças (`git commit -am 'Adiciona uma nova feature'`).
4. Faça o push para o branch (`git push origin minha-nova-feature`).
5. Abra um Pull Request.

## Licença

Este plugin é licenciado sob a GNU General Public License v2.0 ou posterior. Para mais detalhes, veja o arquivo [LICENSE](https://www.gnu.org/licenses/gpl-2.0.html).
